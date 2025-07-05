const fs = require("fs");

const theme = JSON.parse(fs.readFileSync("theme.json", "utf8"));

const SPACING_VAR_PREFIX = "--wp--preset--spacing--";
const COLOR_VAR_PREFIX = "--wp--preset--color--";

// Define static breakpoints
const breakpoints = {
  sm: "480px",
  md: "768px",
  lg: "1024px"
};

const getSpacingMap = () => {
  const spacings = theme.settings?.spacing?.spacingSizes || [];
  return spacings.map(({ slug }) => `  ${slug}: var(${SPACING_VAR_PREFIX}${slug})`).join(",\n");
};

const getColorMap = () => {
  const colors = theme.settings?.color?.palette || [];
  return colors.map(({ slug }) => `  ${slug}: var(${COLOR_VAR_PREFIX}${slug})`).join(",\n");
};

const spacingProps = [
  ["m", "margin"],
  ["mt", "margin-top"],
  ["mr", "margin-right"],
  ["mb", "margin-bottom"],
  ["ml", "margin-left"],
  ["mx", ["margin-left", "margin-right"]],
  ["my", ["margin-top", "margin-bottom"]],
  ["p", "padding"],
  ["pt", "padding-top"],
  ["pr", "padding-right"],
  ["pb", "padding-bottom"],
  ["pl", "padding-left"],
  ["px", ["padding-left", "padding-right"]],
  ["py", ["padding-top", "padding-bottom"]],
  ["gap", "gap"]
];

const generateSpacingUtilities = () => {
  let base = [];
  let responsive = {};

  for (const [short, prop] of spacingProps) {
    for (const { slug } of theme.settings?.spacing?.spacingSizes || []) {
      // Base class
      if (Array.isArray(prop)) {
        base.push(`.${short}-${slug} { ${prop.map(p => `${p}: var(${SPACING_VAR_PREFIX}${slug})`).join("; ")}; }`);
      } else {
        base.push(`.${short}-${slug} { ${prop}: var(${SPACING_VAR_PREFIX}${slug}); }`);
      }

      // Responsive classes
      for (const [bpKey, bpVal] of Object.entries(breakpoints)) {
        const className = `.${bpKey}\\:${short}-${slug}`;
        const css =
          Array.isArray(prop)
            ? `${className} { ${prop.map(p => `${p}: var(${SPACING_VAR_PREFIX}${slug})`).join("; ")}; }`
            : `${className} { ${prop}: var(${SPACING_VAR_PREFIX}${slug}); }`;
        if (!responsive[bpKey]) responsive[bpKey] = [];
        responsive[bpKey].push(css);
      }
    }
  }

  const responsiveBlocks = Object.entries(responsive)
    .map(
      ([bp, rules]) =>
        `@media (min-width: ${breakpoints[bp]}) {\n  ${rules.join("\n  ")}\n}`
    )
    .join("\n\n");

  return [...base, "", responsiveBlocks].join("\n");
};

const generateColorUtilities = () => {
  const base = [];
  const responsive = {};

  for (const { slug } of theme.settings?.color?.palette || []) {
    base.push(`.text-${slug} { color: var(${COLOR_VAR_PREFIX}${slug}); }`);
    base.push(`.bg-${slug} { background-color: var(${COLOR_VAR_PREFIX}${slug}); }`);

    for (const [bpKey, bpVal] of Object.entries(breakpoints)) {
      const textClass = `.${bpKey}\\:text-${slug} { color: var(${COLOR_VAR_PREFIX}${slug}); }`;
      const bgClass = `.${bpKey}\\:bg-${slug} { background-color: var(${COLOR_VAR_PREFIX}${slug}); }`;

      if (!responsive[bpKey]) responsive[bpKey] = [];
      responsive[bpKey].push(textClass);
      responsive[bpKey].push(bgClass);
    }
  }

  const responsiveBlocks = Object.entries(responsive)
    .map(
      ([bp, rules]) =>
        `@media (min-width: ${breakpoints[bp]}) {\n  ${rules.join("\n  ")}\n}`
    )
    .join("\n\n");

  return [...base, "", responsiveBlocks].join("\n");
};

const sassContent = `
// === Breakpoints ===
$breakpoints: (
  sm: 480px,
  md: 768px,
  lg: 1024px
);

// === Spacing Map ===
$spacing-map: (
${getSpacingMap()}
);

// === Color Map ===
$color-map: (
${getColorMap()}
);

// === Spacing Utilities ===
${generateSpacingUtilities()}

// === Color Utilities ===
${generateColorUtilities()}
`;

fs.writeFileSync("assets/scss/_wp-utils.scss", sassContent);
console.log("✅ Generated: _wp-utils.scss");
