<template>
  <div class="book-list">
    <h1>Book List</h1>
    <div v-if="loading">Loading...</div>
    <table v-if="books.length > 0">
      <thead>
        <tr>
          <th>Book Name</th>
          <th>Description</th>
          <th>Category</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in books" :key="book.id">
          <td>{{ book.name }}</td>
          <td>{{ book.description }}</td>
          <td>{{ book.category }}</td>
          <td>{{ book.type }}</td>
        </tr>
      </tbody>
    </table>
    <div v-else-if="!loading">No books available.</div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'BookList',
  data() {
    return {
      books: [],
      loading: true
    };
  },
  mounted() {
    const token = localStorage.getItem('token');
    axios.get('http://127.0.0.1:8000/api/books', {
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-type': 'application/json'
      }
    })
    .then(response => {
      console.log('Response data:', response.data);
      if (response.data && Array.isArray(response.data.books)) {
        this.books = response.data.books;
      } else {
        console.error('Expected an array but got:', typeof response.data.books);
      }
      this.loading = false;
    })
    .catch(error => {
      console.error('Error fetching book list:', error);
      this.loading = false;
    });
  }
};
</script>

<style scoped>
.book-list {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background-color: #f9f9f9;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.book-list h1 {
  text-align: center;
  color: #333;
  margin-bottom: 20px;
}

.book-list table {
  width: 100%;
  border-collapse: collapse;
}

.book-list th,
.book-list td {
  border: 1px solid #ccc;
  padding: 8px;
}

.book-list th {
  background-color: #f2f2f2;

}

.book-list tbody tr:nth-child(even) {
  background-color: #f2f2f2;
 
}

.book-list tbody tr:hover {
  background-color: #ddd;
}
td{
  color: black;
}
</style>
