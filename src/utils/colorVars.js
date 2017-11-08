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
    darker: ["#A08F75", "#A08F75"]
  },
  lightred: "#FB5B64"
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
    bg: colors.blue,
    text: colors.white
  },
  merch: {
    bg: colors.gold.darker[1],
    text: colors.white
  },
  om: {
    bg: colors.gold.darker[1],
    text: colors.white
  },
  kontakt: {
    bg: colors.darkblue.lighter[0],
    text: colors.white
  }
}
