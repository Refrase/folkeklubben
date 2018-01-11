export const today8Digits = {
  methods: {
    today8Digits() {
      const today = new Date()
      const todayFull = today.getFullYear() + '' + ( today.getMonth() < 10 ? '0' : '' ) + ( today.getMonth() + 1 ) + '' + ( today.getDate() < 10 ? '0' : '' ) + today.getDate()
      return parseInt(todayFull)
    }
  }
}
