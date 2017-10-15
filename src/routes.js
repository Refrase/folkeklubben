// See here for making Vue routes correspond to default WP routes: https://deliciousbrains.com/creating-a-wordpress-theme-using-the-rest-api-and-vue-js/

import start from '@/routes/start'
import news from '@/routes/news'

export const routes = [
  { path: '/', component: start, name: 'start' },
  { path: '/nyheder', component: news, name: 'nyheder' }
]
