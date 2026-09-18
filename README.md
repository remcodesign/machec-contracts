# machec/contracts

Shared Composer package for the Machec Laravel Cloud apps — value objects,
casts, and services reused by `customer-identity`, `commercial-core`, and
`logistics-wms`. **Never a dependency of `pim-core`** (D53).

Full context, decisions, and step-by-step build plan live in
`docs_local/specs-final.md` (Decision Ledger D1–D91) and
`docs_local/specs-overview.md` — this README only covers this repo's own
release mechanics.

## Tagging a release

This package is consumed by the three apps via a Composer VCS repository
entry, not Packagist, so a version is just a git tag:

```bash
# 1. Commit the change (composer.json bump if needed, new src/ classes, etc.)
git add -A
git commit -m "feat: <what landed, and which spec step>"

# 2. Tag it — semver, no "v" prefix drift: keep it consistent, e.g. 0.1.0
git tag -a 0.1.0 -m "0.1.0: <short summary>"

# 3. Push the commit and the tag — ask for confirmation first, every time
git push origin main
git push origin 0.1.0
```

**Never push or tag without asking first** (D90) — same git-safety posture
as `machec-gcp`. This applies to every commit on this repo going forward,
not just the initial scaffold.

Consuming apps pin a version range in their own `composer.json`:

```json
{
    "repositories": [
        {"type": "vcs", "url": "git@github.com:remcodesign/machec-contracts.git"}
    ],
    "require": {
        "machec/contracts": "^0.2"
    }
}
```

After tagging a new release, bump the constraint in each consuming app
(`composer update machec/contracts`) — this is a manual step per app, not
automated by this repo.

## What's already here

- `composer.json` — package name `machec/contracts`, PSR-4
  `Machec\Contracts\` → `src/` (Step 0.5, D90).
- `src/Enums/RoleName.php` (Step 2.3, D12/D53) — `Customer`/`CustomerAdmin`/
  `DataAdmin`/`CommercialAdmin`/`WmsAdmin` cases, backing the `roles.name`
  rows those three apps seed. `pim_admin` is deliberately **not** a case
  here (D53) — `pim-core` checks it as a plain string literal against its
  own local roles table instead. First consumed by `customer-identity`'s
  `Step 2.3` seeder; `commercial-core`/`logistics-wms` pick it up whenever
  their own Step 5.0/8.0 actually mounts this package, not before.
- `src/MachecContractsServiceProvider.php` (Step 2.5, D87) — registers the
  `machec` view namespace and the `Machec\Contracts\View\Components` Blade
  component namespace, auto-discovered via `composer.json`'s `extra.laravel`
  key. `src/View/Components/{AdminNav,StatTile}.php` +
  `resources/views/components/{admin-nav,stat-tile}.blade.php` (D20/D87) —
  `<x-machec::admin-nav :links="[...]" />` (each app passes its own switcher
  targets in, since only the consuming app knows the other two apps' URLs)
  and `<x-machec::stat-tile label="..." :value="..." />`, first consumed by
  `customer-identity`'s `Step 2.5`.
- `src/Mail/MachecMailable.php` (Step 2.7, D79) — shared branded base for
  every outbound email; a concrete Mailable supplies `subject()`/`view()`
  (and optionally `data()`), `content()` wraps that view in the one shared
  `resources/views/mail/layout.blade.php`. First consumed by
  `customer-identity`'s password-reset placeholder
  (`AdminPasswordResetNotificationMail`/`CustomerPasswordResetAcknowledgementMail`);
  Domain 9's order-confirmation mail becomes the second consumer later.

## What's still needed for v1

Each of these is its own commit + new tag on this repo, confirmed with the
human before pushing (D90). Do not build any of them ahead of the step that
calls for them — no speculative scaffolding "while we're here."

| Step | Adds | Consumed by |
| --- | --- | --- |
| **5.2** | `Money` value object + `MoneyCast` (D25 — integer cents, never `float`/`decimal`) | `commercial-core` |
| **5.3** | `CircuitBreaker` / `CircuitBreakerState` shared service (D36) | `commercial-core`, `logistics-wms` |

`pim-core` never requires this package (D53) — it keeps local copies of
`Money`/`MoneyCast`/the stat-tile instead (already noted in its own repo).

When one of these steps lands, the consuming app(s) each need a Composer
change too: add the `repositories` VCS entry above (first time only) plus
`require: {"machec/contracts": "^0.1"}`, then bump the constraint as later
tags arrive.
