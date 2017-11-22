import { routeColors } from './colorVars'
export const decideRouteBackgroundColor = {
  methods: {
    decideRouteBackgroundColor( colorNameWP, routeLowercase ) {
      const colorObj = wp.colors ? wp.colors.find( x => x.name === colorNameWP ) : null
      if ( colorObj && colorObj.color ) return colorObj.color
      else return routeColors[routeLowercase].bg
    }
  }
}
