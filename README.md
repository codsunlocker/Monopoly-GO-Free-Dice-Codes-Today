# SmartLink Tracking Platform — Starter

A dark, responsive PHP/MySQL starter dashboard inspired by the supplied reference screenshots.

## Included
- Login/logout
- Responsive dark dashboard
- Traffic overview cards
- Click analytics chart
- Shorten-link demo UI
- Recent activity
- Recent links
- Country/device/security widgets
- MySQL schema for users, smart links, routing rules, clicks, conversions, offers, logs and security alerts
- Basic redirect starter

## Run locally
1. Install XAMPP/Laragon.
2. Copy this folder into `htdocs`.
3. Create/import `database.sql` in phpMyAdmin.
4. Update MySQL credentials in `config.php`.
5. Open `http://localhost/smartlink_platform/`.
6. Demo login: `admin@example.com` / `admin123`

## Production checklist
- Replace demo authentication with `password_hash()` + `password_verify()`.
- Add CSRF tokens to every state-changing form.
- Validate destination URLs against an allowlist if your business requires it.
- Hash IP addresses rather than storing raw IPs when possible.
- Add rate limiting, bot scoring and audit logging.
- Use HTTPS and secure cookie flags.
- Do not use routing/fraud controls to evade platform policies or deceive visitors.
