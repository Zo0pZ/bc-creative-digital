# Deployment — BC Creative Digital theme

Two independent pieces:

## 1. Release build (automated, GitHub Actions)

`.github/workflows/release.yml` runs on every `v*` tag. It builds
`bc-creative-digital.zip` (via `git archive`, so dev-only files marked
`export-ignore` in `.gitattributes` are excluded) and attaches it to a GitHub Release.

Cut a release:

```bash
# bump Version: in style.css and BC_CD_VERSION in functions.php first
git commit -am "Release vX.Y.Z"
git tag vX.Y.Z
git push && git push origin vX.Y.Z
```

## 2. The live site pulls from GitHub (Git Updater)

The live site (bencoetzee.co.uk) runs the **Git Updater** plugin, which installs and
updates this theme straight from the **private** repo — no server credentials in CI.

Enabled by these headers in `style.css`:

```
Update URI:       https://github.com/Zo0pZ/bc-creative-digital
GitHub Theme URI: https://github.com/Zo0pZ/bc-creative-digital
Primary Branch:   main
Release Asset:    true        # updates from the release zip asset, matching tags
```

### One-time setup (in wp-admin)

1. **Plugins → Add New → Upload Plugin** → `git-updater-14.4.3.zip` → Install → Activate.
2. Create a GitHub **fine-grained PAT**: owner Zo0pZ, repo `bc-creative-digital`,
   permission **Contents: Read-only**.
3. **Settings → Git Updater → GitHub** → paste the token → Save.
4. **Settings → Git Updater → Install Theme** → URI `Zo0pZ/bc-creative-digital`,
   branch `main` → Install.
5. **Backuply backup**, then **Appearance → Themes → Live Preview → Activate**.
   Clear **SpeedyCache** afterwards.

### Updating the live theme later

Push a new `vX.Y.Z` tag (section 1). Git Updater then shows a theme update in
**Dashboard → Updates** to apply — or enable auto-updates for the theme to make it hands-off.
