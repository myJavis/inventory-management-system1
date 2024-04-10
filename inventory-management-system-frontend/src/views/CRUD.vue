<template>
  <main>
    <div class="py-4 container-fluid">
      <div class="row">
        <!-- New Products Card -->
        <div class="col-lg-3 col-md-6 col-12">
          <mini-statistics-card title="New Products" :value="newProductsCount" description="Total new products" :icon="{
            component: 'ni ni-shop',
            background: 'bg-gradient-primary',
            shape: 'rounded-circle',
          }" />
        </div>
        <!-- Total Products Card -->
        <div class="col-lg-3 col-md-6 col-12">
          <mini-statistics-card title="Total Products" :value="totalProductsCount"
            description="Total products in inventory" :icon="{
              component: 'ni ni-box-2',
              background: 'bg-gradient-danger',
              shape: 'rounded-circle',
            }" />
        </div>
        <!-- Total Categories Card -->
        <div class="col-lg-3 col-md-6 col-12">
          <mini-statistics-card title="Total Categories" :value="totalCategoriesCount"
            description="Total categories available" :icon="{
              component: 'ni ni-tag',
              background: 'bg-gradient-success',
              shape: 'rounded-circle',
            }" />
        </div>
        <!-- Total Users Card -->
        <div class="col-lg-3 col-md-6 col-12">
          <mini-statistics-card title="Total Users" :value="totalUsersCount" description="Total users registered" :icon="{
            component: 'ni ni-single-02',
            background: 'bg-gradient-warning',
            shape: 'rounded-circle',
          }" />
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Inventory Management Form -->
      <!-- Inventory Item Form -->
      <div class="row mt-4">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Create Product Item</p>
              </div>
            </div>
            <div class="card-body">
              <form @submit.prevent="createProductItem">
                <div class="row">
                  <div class="col-md-6">
                    <label for="item-name" class="form-control-label">Product Name</label>
                    <argon-input type="text" v-model="productName" />
                  </div>
                  <div class="col-md-6">
                    <label for="item-category" class="form-control-label">Category</label>
                    <select v-model="productCategory" class="form-select">
                      <option value="" disabled selected>Select Category</option>
                      <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.CategoryName }}
                      </option>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="item-description" class="form-control-label">Description</label>
                    <argon-input type="text" v-model="productDescription" />
                  </div>
                  <div class="col-md-6">
                    <label for="item-quantity" class="form-control-label">Quantity</label>
                    <argon-input type="number" v-model="productQuantity" />
                  </div>
                  <div class="col-md-6">
                    <label for="item-unit-price" class="form-control-label">Unit Price</label>
                    <argon-input type="number" v-model="productUnitPrice" />
                  </div>

                </div>
                <argon-button type="submit" color="primary">Create</argon-button>
              </form>
            </div>
          </div>
        </div>


        <!-- Product Category Management Form -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Add Product Category</p>
              </div>
            </div>
            <div class="card-body">
              <form @submit.prevent="createCategory">
                <div class="row">
                  <div class="col-md-12">
                    <label for="category-name" class="form-control-label">Category Name</label>
                    <argon-input type="text" v-model="categoryName" />
                  </div>
                </div>
                <argon-button type="submit" color="primary">Add</argon-button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="mt-4 row">
      <div class="col-12">
        <div class="card">
          <div class="card-header pb-0">
            <h6>Products Table</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">ID</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Product
                      Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                      Description</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Quantity
                      Available</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Unit
                      Price</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Category
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Created
                      At</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Updated
                      At</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action
                    </th>

                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in products" :key="product.id">
                    <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{ product.id }}</td>
                    <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{ product.ProductName
                      }}</td>
                    <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{ product.Description
                      }}</td>
                    <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{
                      product.QuantityAvailable }}</td>
                    <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{ product.UnitPrice }}
                    </td>
                    <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{ product.CategoryName
                      }}</td>
                    <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{ product.created_at
                      }}</td>
                    <td class="text-secondary text-xs font-weight-bold align-middle text-center">{{ product.updated_at
                      }}</td>
                    <td class="align-middle text-center text-sm">
                      <button @click="editProduct(product.id)" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                      </button>
                      <button @click="deleteProduct(product.id)" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Delete
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success text-white"> <!-- Added bg-success and text-white classes -->
            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
            <button type="button" class="btn-close" aria-label="Close" @click="closeModal"></button>
            <!-- Changed close button class and added click event -->
          </div>
          <div class="modal-body bg-light"> <!-- Added bg-light class -->
            <form @submit.prevent="saveProduct">
              <div class="row">
                <div class="col-md-6">
                  <label for="edit-item-name" class="form-control-label">Product Name</label>
                  <argon-input id="edit-item-name" type="text" v-model="editedProductName" />
                </div>
                <div class="col-md-6">
                  <label for="edit-item-category" class="form-control-label">Category</label>
                  <select id="edit-item-category" v-model="editedProductCategory" class="form-select">
                    <option value="" disabled>Select Category</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                      {{ category.CategoryName }}
                    </option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="edit-item-description" class="form-control-label">Description</label>
                  <argon-input id="edit-item-description" type="text" v-model="editedProductDescription" />
                </div>
                <div class="col-md-6">
                  <label for="edit-item-quantity" class="form-control-label">Quantity</label>
                  <argon-input id="edit-item-quantity" type="number" v-model="editedProductQuantity" />
                </div>
                <div class="col-md-6">
                  <label for="edit-item-unit-price" class="form-control-label">Unit Price</label>
                  <argon-input id="edit-item-unit-price" type="number" v-model="editedProductUnitPrice" />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
            <!-- Added click event -->
            <button type="button" class="btn btn-primary" @click="saveProduct">Save</button>
          </div>
        </div>
      </div>
    </div>


  </main>
</template>

<script setup>
import Swal from 'sweetalert2'

import MiniStatisticsCard from "@/examples/Cards/MiniStatisticsCard.vue";

import { onBeforeMount, onMounted, onBeforeUnmount } from "vue";
import { useStore } from "vuex";

import setNavPills from "@/assets/js/nav-pills.js";
import setTooltip from "@/assets/js/tooltip.js";
import ArgonInput from "@/components/ArgonInput.vue";
import ArgonButton from "@/components/ArgonButton.vue";

const body = document.getElementsByTagName("body")[0];
const store = useStore();

onMounted(() => {
  store.state.isAbsolute = true;
  setNavPills();
  setTooltip();
});

onBeforeMount(() => {
  store.state.imageLayout = "profile-overview";
  store.state.showNavbar = false;
  store.state.showFooter = true;
  store.state.hideConfigButton = true;
  body.classList.add("profile-overview");
});

onBeforeUnmount(() => {
  store.state.isAbsolute = false;
  store.state.imageLayout = "default";
  store.state.showNavbar = true;
  store.state.showFooter = true;
  store.state.hideConfigButton = false;
  body.classList.remove("profile-overview");
});

import { ref } from "vue";
import axios from "axios";




// Data variables
const categoryName = ref(""); // Used for category creation
const productName = ref(""); // Used for product name
const productCategory = ref(""); // Used for product category
const productDescription = ref(""); // Used for product description
const productQuantity = ref(""); // Used for product quantity
const productUnitPrice = ref(""); // Used for product unit price

// Method for creating a category
const createCategory = async () => {
  if (!categoryName.value) {
    // Notify the user with SweetAlert
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please enter a category name.',
    });
    return; // Return false to prevent form submission
  }

  try {
    // Make API call to create category
    const response = await axios.post("http://localhost:8000/api/add-category", {
      CategoryName: categoryName.value,
    });

    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: 'Category Added Successfully!',
    });
    console.log(response.data)
    // Clear form field or update state as needed
    categoryName.value = ""; // Clear the category name field after adding
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: `An error occurred: ${error}`,
    });
  }
};




// Method for creating a product item
const createProductItem = async () => {

  if (!productName.value || !productCategory.value || !productDescription.value || !productQuantity.value || !productUnitPrice.value) {
    // Notify the user with an alert
    Swal.fire({
      icon: 'warning',
      title: 'Required Fields!',
      text: 'Please fill in all required fields for creating a product.',
    });
    return; // Return false to prevent form submission
  }

  try {
    // Make API call to create product item
    const response = await axios.post("http://localhost:8000/api/add-product", {
      ProductName: productName.value,
      CategoryID: productCategory.value,
      Description: productDescription.value,
      QuantityAvailable: productQuantity.value,
      UnitPrice: productUnitPrice.value,
    });
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: 'Product Added Successfully!',
    });
    console.log(response.data)
    // Clear form fields or update state as needed
    productName.value = "";
    productCategory.value = "";
    productDescription.value = "";
    productQuantity.value = "";
    productUnitPrice.value = "";

    // Fetch updated products data after successful creation
    fetchProducts();

  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: `An error occurred: ${error}`,
    });
  }
};

// Define reactive variables
const newProductsCount = ref(0); // Initialize with actual data from API
const totalProductsCount = ref(0); // Initialize with actual data from API
const totalCategoriesCount = ref(0); // Initialize with actual data from API
const totalUsersCount = ref(0); // Initialize with actual data from API
const categories = ref([]); // Used to store categories from the API

// Fetch data from your Laravel API endpoints when the component is mounted
const fetchData = async () => {
  try {
    const response = await axios.get("http://localhost:8000/api/dashboard"); // Adjust the API endpoint URL as per your setup

    // Manually check each value from the API response and set to 0 if falsy
    newProductsCount.value = JSON.stringify(response.data.newProductsCount);
    totalProductsCount.value = JSON.stringify(response.data.totalProductsCount);
    totalCategoriesCount.value = JSON.stringify(response.data.totalCategoriesCount);
    totalUsersCount.value = JSON.stringify(response.data.totalUsersCount);
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: `Error fetching data: ${error}`,
    });
  }
};

// Method to fetch categories from the API
const fetchCategories = async () => {
  try {
    const response = await axios.post("http://localhost:8000/api/get-categories");
    categories.value = response.data; // Update categories array with API response
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: 'Error fetching categories: ' + error.message,
    });
  }
};

const products = ref([]);

const fetchProducts = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/get-products');
    products.value = response.data;
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: `Error fetching categories: ${error}`,
    });
  }
};

// Define reactive variables
const editedProductName = ref('');
const editedProductCategory = ref('');
const editedProductDescription = ref('');
const editedProductQuantity = ref('');
const editedProductUnitPrice = ref('');
// Define reactive variable for productId
const productId = ref(null);

// Method to handle editing a product
const editProduct = (selectedProductId) => {
  // Find the product in the products array based on productId
  const productToEdit = products.value.find(product => product.id === selectedProductId);

  console.log(productToEdit.CategoryName);

  // Populate the modal fields with product details
  editedProductName.value = productToEdit.ProductName;
  editedProductCategory.value = productToEdit.CategoryID;
  editedProductDescription.value = productToEdit.Description;
  editedProductQuantity.value = productToEdit.QuantityAvailable;
  editedProductUnitPrice.value = productToEdit.UnitPrice;
  // Set the productId for use in saveProduct function
  productId.value = selectedProductId; // Use a different variable name to avoid conflicts

  // Show the modal
  const modal = document.querySelector('#editProductModal');
  modal.classList.add('show');
  modal.style.display = 'block';

  // Set the category in the select dropdown
  const selectCategory = document.querySelector('#edit-item-category');
  selectCategory.value = editedProductCategory.value;
};

// Method to close the modal
const closeModal = () => {
  const modal = document.querySelector('#editProductModal');
  modal.classList.remove('show');
  modal.style.display = 'none'; // Hide the modal

  // Remove the modal backdrop if it exists
  const modalBackdrop = document.querySelector('.modal-backdrop');
  if (modalBackdrop) {
    modalBackdrop.remove();
  }

  // Restore body scrolling ability
  document.body.classList.remove('modal-open');
};




// Method to save edited product
const saveProduct = async () => {

  if (!editedProductName.value || !editedProductCategory.value || !editedProductDescription.value || !editedProductQuantity.value || !editedProductUnitPrice.value) {
    // Notify the user with an alert
    Swal.fire({
      icon: 'warning',
      title: 'Incomplete Data!',
      text: 'Please fill in all required fields for editing a product.',
    });
    return; // Return false to prevent form submission
  }

  try {
    const response = await axios.put(`http://localhost:8000/api/products/${productId.value}`, {
      ProductName: editedProductName.value,
      CategoryID: editedProductCategory.value,
      Description: editedProductDescription.value,
      QuantityAvailable: editedProductQuantity.value,
      UnitPrice: editedProductUnitPrice.value,
    });
    console.log('Updated product:', response.data);
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: 'Updated product successfully!',
    });
    // Close the modal
    const modal = document.querySelector('#editProductModal');
    modal.classList.remove('show');
    modal.style.display = 'none';
    // Refresh products data after successful update
    fetchProducts();
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: 'Error updating product: ' + error.message,
    });
  }
};


// Method to handle deleting a product
const deleteProduct = async (productId) => {
  try {
    const response = await axios.delete(`http://localhost:8000/api/delete-product/${productId}`);
    console.log('Deleted product:', response.data);
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: 'Successfully deleted product!',
    });
    // Refresh products data after deletion
    fetchProducts();
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: 'Error deleting product: ' + error.message,
    });
  }
};

onMounted(fetchProducts);

// Call fetchCategories when the component is mounted
onMounted(fetchCategories);

// Call fetchData when the component is mounted
onMounted(fetchData);
</script>
