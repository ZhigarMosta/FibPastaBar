import { defineStore } from 'pinia'
import { useLocalStorageRef } from './backet'

interface UserInterface{
  email:string
  name:string
}

export const useUserStore = defineStore('user', () => {
  const user = useLocalStorageRef<UserInterface>("user", {email:"",name:""})
  
  return {user}
})
