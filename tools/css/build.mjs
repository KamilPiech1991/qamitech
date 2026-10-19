// Buduje site/assets/css/vendor.min.css i main.min.css z plików źródłowych obok nich.
// Z vendor.css usuwa martwy kod: Font Awesome (ikony social w stopce są zakomentowane)
// oraz klasy .material-icons.<nazwa> (strona używa ikon przez ligatury, np. <i class="material-icons">phone</i>).
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import postcss from 'postcss';
import CleanCSS from 'clean-css';

const cssDir = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '../../site/assets/css');
const DEAD_SELECTOR = /^\.(fa[a-z0-9-]*|material-icons\.[a-z0-9_]+)\b/;

function stripDeadIcons(css) {
  const root = postcss.parse(css);
  root.walkRules((rule) => {
    const kept = rule.selectors.filter((s) => !DEAD_SELECTOR.test(s.trim()));
    if (kept.length === 0) rule.remove();
    else if (kept.length !== rule.selectors.length) rule.selectors = kept;
  });
  root.walkAtRules('font-face', (at) => {
    if (at.toString().includes('Font Awesome')) at.remove();
  });
  return root.toString();
}

const files = [
  { name: 'vendor', transform: stripDeadIcons },
  { name: 'main', transform: (css) => css },
];

for (const { name, transform } of files) {
  const source = fs.readFileSync(path.join(cssDir, `${name}.css`), 'utf8');
  const result = new CleanCSS({ level: 1, rebase: false }).minify(transform(source));
  if (result.errors.length) throw new Error(`${name}.css: ${result.errors.join('; ')}`);
  fs.writeFileSync(path.join(cssDir, `${name}.min.css`), result.styles + '\n');
  console.log(`${name}.min.css: ${(source.length / 1024).toFixed(0)} KB → ${(result.styles.length / 1024).toFixed(0)} KB`);
}
