export const colors = {
  white: "#ffffff",
  darkblue: {
    base: "#2B2847",
    lighter: ["#4b4863"],
    darker: []
  },
  blue: "#2C70B6",
  gold: {
    base: "#DEC7A2",
    darker: ["#A08F75", "#A08F75", "#7f715c", "#5b5242"]
  },
  lightred: "#FB5B64",
  orange: "#FF5837"
}

export const routeColors = {
  velkommen: {
    bg: 'transparent',
    text: colors.darkblue.base,
  },
  nyheder: {
    bg: colors.white,
    text: colors.darkblue.base,
  },
  koncerter: {
    bg: colors.lightred,
    text: colors.white
  },
  musik: {
    bg: colors.darkblue.base,
    text: colors.white
  },
  merch: {
    bg: colors.gold.darker[1],
    text: colors.white
  },
  presse: {
    bg: colors.gold.darker[3],
    text: colors.white
  },
  kontakt: {
    bg: colors.gold.darker[3],
    text: colors.white
  }
}
