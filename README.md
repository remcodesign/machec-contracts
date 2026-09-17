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
        "machec/contracts": "^0.1"
    }
}
```

After tagging a new release, bump the constraint in each consuming app
(`composer update machec/contracts`) — this is a manual step per app, not
automated by this repo.

## What's already here (Step 0.5, D90)

- `composer.json` — package name `machec/contracts`, PSR-4
  `Machec\Contracts\` → `src/`.
- Empty `src/` — no real classes yet.

## What's still needed for v1

Each of these is its own commit + new tag on this repo, confirmed with the
human before pushing (D90). Do not build any of them ahead of the step that
calls for them — no speculative scaffolding "while we're here."

| Step | Adds | Consumed by |
| --- | --- | --- |
| **2.5** | `<x-machec::admin-nav>`, `<x-machec::stat-tile>` Blade components (D87/D88) | `customer-identity` (first), later `commercial-core` |
| **5.2** | `Money` value object + `MoneyCast` (D25 — integer cents, never `float`/`decimal`) | `commercial-core` |
| **5.3** | `CircuitBreaker` / `CircuitBreakerState` shared service (D36) | `commercial-core`, `logistics-wms` |

`pim-core` never requires this package (D53) — it keeps local copies of
`Money`/`MoneyCast`/the stat-tile instead (already noted in its own repo).

When one of these steps lands, the consuming app(s) each need a Composer
change too: add the `repositories` VCS entry above (first time only) plus
`require: {"machec/contracts": "^0.1"}`, then bump the constraint as later
tags arrive.
