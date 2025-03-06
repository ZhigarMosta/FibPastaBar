import { defineStore } from 'pinia'
import { useLocalStorageRef } from './backet'

interface UserInterface{
  email:string
  name:string
  id:number|undefined
}

export const useUserStore = defineStore('user', () => {
  const user = useLocalStorageRef<UserInterface>("user", {email:"",name:"",id:undefined})
  
  return {user}
})
