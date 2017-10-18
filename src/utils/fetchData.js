export const fetchData = {
  methods: {
    fetchData( endpoint ) {
      return new Promise( (resolve, reject) => {
        if ( !endpoint ) return console.log( 'No endpoint provided' )
        return this.$http
        .get( wp.rest_root + 'wp/v2/' + endpoint )
        .then( (response) => {
          if ( response && response.ok ) {
            resolve(response.body)
          } else {
            console.log('Responded with statuscode ' + status + '. Could not load data from ' + endpoint)
            reject()
          }
        })
      })
    }
  }
}
