const fs = require("fs");
const theme = JSON.parse(fs.readFileSync("theme.json", "utf8"));

const SPACING_VAR_PREFIX = "--wp--preset--spacing--";
const COLOR_VAR_PREFIX = "--wp--preset--color--";
const FONT_FAMILY_VAR_PREFIX = "--wp--preset--font-family--";
const FONT_SIZE_VAR_PREFIX = "--wp--preset--font-size--";

// Define states for color modifiers
const states = {
  hover: "hover",
  focus: "focus",
  focvis: "focus-visible"
}

const displays = [
  "none",
  "grid",
  "flex",
  "inline-flex",
  "block",
  "inline-block",
  "inline"
]

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

console.log();
console.log("---------------------------------------");
console.log("🏗️  Building CSS from theme.json file...");
console.log("---------------------------------------");
console.log();

const breakpoints = theme.settings?.custom?.breakpoints || {}

const getBreakPointMap = () => {
  return Object.entries(breakpoints).map(([slug, val]) => `  ${slug}: ${val},`).join("\n")
}

const getBreakPointVars = () => {
  return Object.entries(breakpoints).map(([slug, val]) => `$bp-${slug}: ${val};`).join("\n")
}

const getSpacingMap = () => {
  const spacings = theme.settings?.spacing?.spacingSizes || [];
  return spacings.map(({ slug }) => `  ${slug}: var(${SPACING_VAR_PREFIX}${slug})`).join(",\n");
};

const getColorMap = () => {
  const colors = theme.settings?.color?.palette || [];
  return colors.map(({ slug }) => `  ${slug}: var(${COLOR_VAR_PREFIX}${slug})`).join(",\n");
};

const generateDisplay = () => {
  const results = []

  for(const display of displays){
    results.push(`.d-${display} { display: ${display}; }`)
  }

  for(const [bpKey, bpVal] of Object.entries(breakpoints)){
    results.push(`\n@media (min-width: ${bpVal}) {`)
    for(const display of displays){
      results.push(`.${bpKey}\\:d-${display} { display: ${display}; }`)
    }
    results.push(`}`)
  }

  return results.join('\n')
}

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
  const stateRules = {};

  for (const { slug } of theme.settings?.color?.palette || []) {
    base.push(`.text-${slug} { color: var(${COLOR_VAR_PREFIX}${slug}); }`);
    base.push(`.bg-${slug} { background-color: var(${COLOR_VAR_PREFIX}${slug}); }`);

    for (const [state, stateCssRule] of Object.entries(states)) {
      const textClass = `.${state}\\:text-${slug}:${stateCssRule} { color: var(${COLOR_VAR_PREFIX}${slug}); }`;
      const bgClass = `.${state}\\:bg-${slug}:${stateCssRule} { background-color: var(${COLOR_VAR_PREFIX}${slug}); }`;

      if (!stateRules[state]) stateRules[state] = [];
      stateRules[state].push(textClass);
      stateRules[state].push(bgClass);
    }
  }

  const stateBlocks = Object.entries(stateRules)
    .map(
      ([state, rules]) =>
        `\n${rules.join("\n")}\n`
    )
    .join("\n\n");

  return [...base, "", stateBlocks].join("\n");
};

const generateBorderRadiusUtilities = () => {
  let classNames = []
  const settings = theme.settings?.custom?.borderRadius || [];

  for (const [slug, _value] of Object.entries(settings)) {
    classNames.push(`.rounded-${slug} { border-radius: var(--wp--custom--border-radius--${slug}); }`);
  }

  return classNames.join("\n")
}

const generateFontUtilities = () => {
  const fonts = theme.settings?.typography?.fontFamilies || [];
  const sizes = theme.settings?.typography?.fontSizes || [];

  let base = [];
  let responsive = {};

  // Font family
  for (const { slug } of fonts) {
    base.push(`.font-${slug} { font-family: var(${FONT_FAMILY_VAR_PREFIX}${slug}); }`);
  }

  // Font size
  for (const { slug } of sizes) {
    base.push(`.text-${slug} { font-size: var(${FONT_SIZE_VAR_PREFIX}${slug}); }`);

    for (const [bpKey] of Object.entries(breakpoints)) {
      const className = `.${bpKey}\\:text-${slug}`;
      const rule = `${className} { font-size: var(${FONT_SIZE_VAR_PREFIX}${slug}); }`;
      if (!responsive[bpKey]) responsive[bpKey] = [];
      responsive[bpKey].push(rule);
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

const sassVars = `
// === Breakpoints Map ===
$breakpoints: (
${getBreakPointMap()}
);

// === Breakpoints Quick Utils ===
${getBreakPointVars()}

// === Spacing Map ===
$spacing: (
${getSpacingMap()}
);

// === Color Map ===
$colors: (
${getColorMap()}
);
`

const sassUtils = `
// === Display Utilities ===
${generateDisplay()}

// === Color Utilities ===
${generateColorUtilities()}

// === Typography Utilities ===
${generateFontUtilities()}

// === Border Radius Utilities ===
${generateBorderRadiusUtilities()}

// === Spacing Utilities ===
${generateSpacingUtilities()}
`;

fs.writeFileSync("assets/scss/_wp-vars.scss", sassVars);
console.log("✅ Generated: assets/scss/_wp-vars.scss");
fs.writeFileSync("assets/scss/_wp-utils.scss", sassUtils);
console.log("✅ Generated: assets/scss/_wp-utils.scss");

console.log()
console.log("🚀 All done!")
console.log()
console.log("---------------------------------------");
