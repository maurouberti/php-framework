import Vue from 'vue'
import Router from 'vue-router'
import Projects from '@/components/Projects'
import ProjectList from '@/components/projects/List'
import ProjectShow from '@/components/projects/Show'
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
      component: Projects,
      children: [
        {
          path: '',
          name: 'ProjectList',
          component: ProjectList,
        },
        {
          path: ':id',
          name: 'ProjectList',
          component: ProjectShow,
        }
      ]
    },
    {
      path: '/schedule',
      name: 'Schedule',
      component: Schedule
    }
  ]
})
