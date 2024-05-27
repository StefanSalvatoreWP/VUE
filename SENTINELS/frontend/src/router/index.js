import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import AdminDashboard from '../views/AdminDashboard.vue';
import ManageBooks from '../views/ManageBooks.vue';
import Reader from '../views/Reader.vue';
import BookList from '../views/BookList.vue';
import Readerlist from '../views/Readerlist.vue'; 
import axios from '../axios';

const routes = [
  { path: '/home', name: 'Home', component: Home },
  { path: '/', name: 'Login', component: Login },
  { path: '/register', name: 'Register', component: Register },
  {
    path: '/admin',
    name: 'AdminDashboard',
    component: AdminDashboard,
    meta: { requiresAuth: true }, 
    children: [
      { path: 'books', name: 'ManageBooks', component: ManageBooks },
      { path: 'reader', name: 'Reader', component: Reader },
      { path: 'booklist', name: 'BookList', component: BookList },
      { path: 'readerlist', name: 'Readerlist', component: Readerlist } 
    ]
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach(async (to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  
  if (requiresAuth) {
    const token = localStorage.getItem('token');
    if (!token) {
      next({ name: 'Login' });
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;
