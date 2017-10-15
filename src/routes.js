// See here for making Vue routes correspond to default WP routes: https://deliciousbrains.com/creating-a-wordpress-theme-using-the-rest-api-and-vue-js/

import start from '@/routes/start'
import news from '@/routes/news'
import concerts from '@/routes/concerts'

export const routes = [
  { path: '/', component: start, name: 'start' },
  { path: '/nyheder', component: news, name: 'nyheder' },
  { path: '/koncerter', component: concerts, name: 'koncerter' }
]
