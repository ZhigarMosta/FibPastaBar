import { defineStore } from 'pinia'
import { useLocalStorageRef, type BacketInterface } from './backet'

interface OrderInterface{
    message:string,
    order:{
        id:number,
        user_id:number|null
        products_data:string[],
        promotional_code_id:number|null,
        addres_sity:string|null,
        addres_house:string|null,
        addres_entrance:string|null,
        addres_apartment:string|null,
        addres_floor:string|null,
        addres_code:string|null,
        addres_name_addres:string|null,
        addres_comment_addres:string|null,
        time:string,
        cost:number,
        created_at:string,
        updated_at:string
        buyer_name:string;
        buyer_email:string;
    }
    promotional_code:{
        id:number,
        code:string,
        valid_until:string,
        discount_percentage:number
        is_active:number
    },
    products:BacketInterface[]
    success: boolean
} 

export const useOrderStore = defineStore('order', () => {
     const order = useLocalStorageRef<OrderInterface|undefined>("order", undefined)
  
  return {order}
})
