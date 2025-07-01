import { createApp } from 'vue'
import './bootstrap'

// Import components
import ExampleComponent from './components/ExampleComponent.vue'

// Create Vue application
const app = createApp({})

// Register components
app.component('example-component', ExampleComponent)

// Mount application
app.mount('#app')
