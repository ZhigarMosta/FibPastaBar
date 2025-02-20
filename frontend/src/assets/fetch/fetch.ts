import { ref, toValue, watchEffect, type MaybeRef } from "vue";

export function useFetch<T = unknown>(url: MaybeRef<string>, fetchOptions?: MaybeRef<RequestInit>) {
  const data = ref<T>();
  const isLoading = ref < boolean > (true);

  const fetchData = () => {
    data.value = undefined;
    isLoading.value = true;
    
    const options = toValue(fetchOptions)??{}
    if(options?.headers===undefined){
      options.headers=new Headers
    }
    fetch(toValue(url), toValue(fetchOptions))
      .then((res) => {
        console.log(res)
        return res.json()
      })
      .then((json) => {
        data.value = json;
        console.log(json)
        isLoading.value = false;
      })
      .catch((err) => (err));
  };
  watchEffect(() => {
    fetchData();
  });

  return {
    data,
    isLoading,
  }
}