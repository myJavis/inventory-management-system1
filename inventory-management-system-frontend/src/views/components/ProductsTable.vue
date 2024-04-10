<template>
  <div class="card">
    <div class="card-header pb-0">
      <h6>Products Table</h6>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product Name</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity Available</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Price</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category ID</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated At</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products" :key="product.id">
              <td class="align-middle text-center text-sm">{{ product.id }}</td>
              <td class="align-middle text-center text-sm">{{ product.ProductName }}</td>
              <td class="align-middle text-center text-sm">{{ product.Description }}</td>
              <td class="align-middle text-center text-sm">{{ product.QuantityAvailable }}</td>
              <td class="align-middle text-center text-sm">{{ product.UnitPrice }}</td>
              <td class="align-middle text-center text-sm">{{ product.CategoryID }}</td>
              <td class="align-middle text-center text-sm">{{ product.created_at }}</td>
              <td class="align-middle text-center text-sm">{{ product.updated_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const products = ref([]);

const fetchData = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/get-products');
    products.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

onMounted(fetchData);
</script>
