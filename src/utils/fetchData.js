export const fetchData = {
  methods: {
    fetchData( endpoint ) {
      return new Promise( (resolve, reject) => {
        if ( !endpoint ) return console.log( 'No endpoint provided' )
        return this.$http
        .get( wp.rest_root + 'wp/v2/' + endpoint )
        .then( (response) => {
          resolve(response.body)
        }).catch( e => {
          console.log('Responded with statuscode ' + e.status + '. Could not load data from ' + endpoint)
          reject()
        })
      })
    }
  }
}
