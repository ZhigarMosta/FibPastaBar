import { ref, computed, type Ref } from 'vue'
import { defineStore } from 'pinia'

interface BacketInterface{
  id:number,
  img:string,
  name:string,
  price:number,
  count:number
}

function findProductById(product:Ref<Array<BacketInterface>>,id:number){
  return product.value.find(item => item.id === id)
}

export const useBacketStore = defineStore('backet', () => {
  const backet = ref<Array<BacketInterface>>([])
  // const doubleCount = computed(() => backet.value * 2)

  const countProductInBacket = ref(0)

  function addToBacket(data:BacketInterface){
    const product = findProductById(backet,data.id)
    countProductInBacket.value++
    if(!product){
      backet.value.push(data)
    }
    else{
      product.count++
    }
  }

  function incrementCount(id: number) {
    const product = findProductById(backet,id)
    countProductInBacket.value++
    if (product) {
      product.count++
    }
  }

  function decrementCount(id: number) {
    const product = findProductById(backet,id)
    if (product && product.count > 0) {
      countProductInBacket.value--
      product.count--
      if(product.count === 0){
        backet.value = backet.value.filter(item => item.id !== id)
      }
    }
  }  

  return { backet,countProductInBacket, incrementCount, decrementCount,addToBacket }
})
