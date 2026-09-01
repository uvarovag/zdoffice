#!/usr/bin/env bash
#
# Заливает файлы проекта на сервер по SSH/rsync.
#
# По умолчанию заливает только изменённые/незакоммиченные файлы (git status).
# С флагом --full заливает вообще все файлы проекта под git (для первого деплоя).
# С флагом --files заливает только явно перечисленные файлы, независимо от их статуса в git.
#
# Использование:
#   ./deploy.sh                          — залить только изменённые файлы
#   ./deploy.sh --full                   — залить все файлы проекта (первый деплой)
#   ./deploy.sh --files a.php b.php      — залить только указанные файлы
#   ./deploy.sh --dry-run                — только показать, что будет залито
#   ./deploy.sh --full --dry-run

set -euo pipefail

REMOTE_USER="root"
REMOTE_HOST="88.218.62.16"
REMOTE_PATH="/var/www/site_user/data/www/88.218.62.16"

DRY_RUN=0
FULL=0
FILES_MODE=0
FILES_ARG=()

for arg in "$@"; do
	if [[ $FILES_MODE -eq 1 ]]; then
		FILES_ARG+=("$arg")
		continue
	fi

	case "$arg" in
		--dry-run) DRY_RUN=1 ;;
		--full) FULL=1 ;;
		--files) FILES_MODE=1 ;;
	esac
done

if [[ $FILES_MODE -eq 1 && ${#FILES_ARG[@]} -eq 0 ]]; then
	echo "--files требует хотя бы один путь к файлу"
	exit 1
fi

cd "$(git rev-parse --show-toplevel)"

CHANGED_FILES=()
DELETED_FILES=()

if [[ $FILES_MODE -eq 1 ]]; then

	for f in "${FILES_ARG[@]}"; do
		if [[ ! -e "$f" ]]; then
			echo "Файл не найден: $f"
			exit 1
		fi
		CHANGED_FILES+=("$f")
	done

elif [[ $FULL -eq 1 ]]; then

	# Первый деплой — все файлы проекта, отслеживаемые git
	# (только те, что реально есть на диске — git ls-files отдаёт индекс,
	# в котором могут быть файлы, удалённые локально, но ещё не закоммиченные)
	while IFS= read -r line; do
		[[ -n "$line" && -e "$line" ]] && CHANGED_FILES+=("$line")
	done < <(git ls-files)

else

	# Модифицированные/добавленные/переименованные/незакоммиченные файлы (без удалённых)
	while IFS= read -r line; do
		[[ -n "$line" ]] && CHANGED_FILES+=("$line")
	done < <(git status --porcelain=v1 | grep -Ev '^(D| D)' | sed -E 's/^...//' | sed -E 's/.* -> //')

	# Удалённые файлы — отдельно, их нужно убрать на сервере, а не заливать
	while IFS= read -r line; do
		[[ -n "$line" ]] && DELETED_FILES+=("$line")
	done < <(git status --porcelain=v1 | grep -E '^(D| D)' | sed -E 's/^...//')

fi

if [[ ${#CHANGED_FILES[@]} -eq 0 && ${#DELETED_FILES[@]} -eq 0 ]]; then
	echo "Нет изменённых/незакоммиченных файлов, деплоить нечего."
	exit 0
fi

if [[ ${#CHANGED_FILES[@]} -gt 0 ]]; then
	echo "Будут залиты (${#CHANGED_FILES[@]}):"
	printf '  %s\n' "${CHANGED_FILES[@]}"
fi

if [[ ${#DELETED_FILES[@]} -gt 0 ]]; then
	echo "Будут удалены на сервере:"
	printf '  %s\n' "${DELETED_FILES[@]}"
fi

RSYNC_OPTS=(-avz --relative --progress)
if [[ $DRY_RUN -eq 1 ]]; then
	RSYNC_OPTS+=(--dry-run)
fi

if [[ ${#CHANGED_FILES[@]} -gt 0 ]]; then
	printf '%s\n' "${CHANGED_FILES[@]}" | rsync "${RSYNC_OPTS[@]}" \
		--files-from=- \
		./ "${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH}/"
fi

if [[ ${#DELETED_FILES[@]} -gt 0 ]]; then
	for f in "${DELETED_FILES[@]}"; do
		if [[ $DRY_RUN -eq 1 ]]; then
			echo "[dry-run] rm ${REMOTE_PATH}/${f}"
		else
			ssh "${REMOTE_USER}@${REMOTE_HOST}" "rm -f -- '${REMOTE_PATH}/${f}'"
		fi
	done
fi

echo "Готово."
