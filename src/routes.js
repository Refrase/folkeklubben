// WP routes to Vue routes inspired by: https://deliciousbrains.com/creating-a-wordpress-theme-using-the-rest-api-and-vue-js/

// Main routes
import welcome from '@/routes/welcome'
import news from '@/routes/news'
import concerts from '@/routes/concerts'
import music from '@/routes/music'
import merch from '@/routes/merch'
import about from '@/routes/about'
import contact from '@/routes/contact'

import page from '@/routes/page' // Generic route -> Use as base for routes like /post/:id

// Subsite components -> used below for mapping WP routes
import Post from '@/components/Post'
import Release from '@/components/Release'
import Track from '@/components/Track'

let routes = [
  { path: '/', component: page, name: 'page', children: []},
  { path: '/velkommen', component: welcome, name: 'velkommen' },
  { path: '/nyheder', component: news, name: 'nyheder' },
  { path: '/koncerter', component: concerts, name: 'koncerter' },
  { path: '/musik', component: music, name: 'musik' },
  { path: '/merch', component: merch, name: 'merch' },
  { path: '/om', component: about, name: 'om' },
  { path: '/kontakt', component: contact, name: 'kontakt' }
]

// Mapping WP routes to corresponding Vue route (wp.routes made available in functions.php)
// So that everytime a post type is created in wp-admin a corresponding Vue route is created as childroute to the generic page route
// Useful if substuff like release or tracks should have their own urls some time in the future
const subsiteComponents = {
  post: Post,
  release: Release,
  track: Track
}

for (let key in wp.routes) {
  if ( wp.routes[key].type != 'page' ) {

    const wpRoute = wp.routes[key]
    const vueRoute = {
      path: '/' + wpRoute.type + '/:' + wpRoute.type + 'Id',
      component: subsiteComponents[wpRoute.type],
      name: wpRoute.type
    }

    let genericRoute;
    for ( let route of routes ) { if ( route.name === 'page' ) genericRoute = route }
    let routeAlreadyExists = false
    for ( let i = 0; i < genericRoute.children.length; i++ ) {
      if ( genericRoute.children[i].name === wpRoute.type ) routeAlreadyExists = true
    }
    if ( !routeAlreadyExists ) genericRoute.children.push(vueRoute)

  }
}

export { routes }
