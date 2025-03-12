import { ref, type Ref, customRef, triggerRef } from 'vue'
import { defineStore } from 'pinia'


export interface BacketInterface{
  id:number,
  img:string,
  name:string,
  price:number,
  count:number,
  descroption:string
}

export interface AddresInterface{
  addres:{
    sity:string,
    house:string,
    entrance:string,
    apartment:string,
    floor:string,
    code:string,
    nameAddres:string,
    commentAddres:string
  }
  pickup:boolean
}

function findProductById(product:Ref<BacketInterface[]>,id:number){
  return product.value.find(item => item.id === id)
}
export const useBacketStore = defineStore('backet', () => {
   const backet = useLocalStorageRef<BacketInterface[]>("backetList", [])
  // const backet = ref<Array<BacketInterface>>([])
  // const doubleCount = computed(() => backet.value * 2)

  const countProductInBacket = useLocalStorageRef<number>("countProductInBacket",0)
  const costOrder = useLocalStorageRef<number>("costOrder",0)
  const discountOrder = useLocalStorageRef<number>("discountOrder",0)
  const promotionalCode = useLocalStorageRef<string|number>("promotionalCode","")
  
  const delivery = useLocalStorageRef<AddresInterface>("delivery",{addres:{apartment:"",code:"",commentAddres:"",entrance:"",floor:"",house:"",nameAddres:"",sity:""},pickup:false})
  const deliveryTime = useLocalStorageRef<string>("deliveryTime","Побыстрее")

  function addToBacket(data:BacketInterface){
    const product = findProductById(backet,data.id)
    if(!product){
      backet.value.push(data)
      costOrder.value += data.price
      countProductInBacket.value++
      backet.value=[...backet.value]
    }
    else{
      incrementCount(data.id)
    }
  }

  function incrementCount(id: number) {
    const product = findProductById(backet,id)
    countProductInBacket.value++
    if (product) {
      product.count++
      costOrder.value += product.price
      backet.value=[...backet.value]
    }
  }

  function decrementCount(id: number) {
    const product = findProductById(backet,id)
    if (product && product.count > 1) {
      countProductInBacket.value--
      product.count--
      costOrder.value -= product.price 
      backet.value=[...backet.value]
    }
  }

  function deleteProduct(id: number){
    const product = findProductById(backet,id)
      if(product){
        backet.value = backet.value.filter(item => item.id !== id)
        costOrder.value -= product.price * product.count
        countProductInBacket.value -= product.count
      }
  }

  return {backet,countProductInBacket,costOrder,discountOrder,promotionalCode,delivery,deliveryTime,deleteProduct, incrementCount, decrementCount,addToBacket }
})

export function useLocalStorageRef<T = unknown>(
  key: string,
  defaultValue: T
): Ref<T> {
  const storedValue = localStorage.getItem(key);
  let originalValue = storedValue ? JSON.parse(storedValue) : defaultValue;
  return customRef((track, trigger) => {
    return {
      get() {
        track();
        return originalValue;
      },
      set(newValue) {
        trigger();
        originalValue = newValue;
        localStorage.setItem(key, JSON.stringify(originalValue));
      },
    };
  });
}