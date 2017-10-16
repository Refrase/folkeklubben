// See here for making Vue routes correspond to default WP routes: https://deliciousbrains.com/creating-a-wordpress-theme-using-the-rest-api-and-vue-js/

import start from '@/routes/start'
import news from '@/routes/news'
import concerts from '@/routes/concerts'
import music from '@/routes/music'
import merch from '@/routes/merch'
import about from '@/routes/about'
import contact from '@/routes/contact'

export const routes = [
  { path: '/', component: start, name: 'start' },
  { path: '/nyheder', component: news, name: 'nyheder' },
  { path: '/koncerter', component: concerts, name: 'koncerter' },
  { path: '/musik', component: music, name: 'musik' },
  { path: '/merch', component: merch, name: 'merch' },
  { path: '/om', component: about, name: 'om' },
  { path: '/kontakt', component: contact, name: 'kontakt' },
]
