import Vue from 'vue'
import Router from 'vue-router'
import Projects from '@/components/Projects'
import Schedule from '@/components/Schedule'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/projects',
    },
    {
      path: '/projects',
      name: 'Projects',
      component: Projects
    },
    {
      path: '/schedule',
      name: 'Schedule',
      component: Schedule
    }
  ]
})
