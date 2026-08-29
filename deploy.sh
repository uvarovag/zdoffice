#!/usr/bin/env bash
#
# Заливает на сервер только изменённые/незакоммиченные файлы (working tree),
# используя git status как источник списка файлов.
#
# Использование:
#   ./deploy.sh            — залить файлы
#   ./deploy.sh --dry-run  — только показать, что будет залито

set -euo pipefail

REMOTE_USER="root"
REMOTE_HOST="88.218.62.16"
REMOTE_PATH="/var/www/site_user/data/www/88.218.62.16"

DRY_RUN=0
if [[ "${1:-}" == "--dry-run" ]]; then
	DRY_RUN=1
fi

cd "$(git rev-parse --show-toplevel)"

# Модифицированные/добавленные/переименованные/незакоммиченные файлы (без удалённых)
CHANGED_FILES=()
while IFS= read -r line; do
	[[ -n "$line" ]] && CHANGED_FILES+=("$line")
done < <(git status --porcelain=v1 | grep -Ev '^(D| D)' | sed -E 's/^...//' | sed -E 's/.* -> //')

# Удалённые файлы — отдельно, их нужно убрать на сервере, а не заливать
DELETED_FILES=()
while IFS= read -r line; do
	[[ -n "$line" ]] && DELETED_FILES+=("$line")
done < <(git status --porcelain=v1 | grep -E '^(D| D)' | sed -E 's/^...//')

if [[ ${#CHANGED_FILES[@]} -eq 0 && ${#DELETED_FILES[@]} -eq 0 ]]; then
	echo "Нет изменённых/незакоммиченных файлов, деплоить нечего."
	exit 0
fi

if [[ ${#CHANGED_FILES[@]} -gt 0 ]]; then
	echo "Будут залиты:"
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
