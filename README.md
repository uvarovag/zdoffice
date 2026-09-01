# Print Office

Internal order management system (design/production) built with PHP + MySQL.

## Config
- `src/cfg/config_system.php` — DB, host, upload limits
- `src/cfg/config_program.php` — app settings, paid period (`PAID_UNTIL`)

## First run
1. Configure `config_system.php`
2. Open `src/install.php` in a browser once — creates the DB tables

## Deploy
```bash
./deploy.sh                             # only changed/uncommitted files
./deploy.sh --full                      # all project files (first deploy)
./deploy.sh --files a.php b.php         # only the listed files, regardless of git status
./deploy.sh --dry-run                   # preview what would be uploaded, no upload
```

## Admin
Login: `admin`, password stored as a bcrypt hash in `src/data/user_admin_data.php`.
