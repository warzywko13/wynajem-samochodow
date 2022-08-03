//dane niezmienne
const package = document.querySelector("#package");
const days = document.querySelector("#days");
const vmax = document.querySelector("#calc_vmax").innerHTML;

function work(){
   //pobrane dane do obliczen
   const cost = document.querySelector("#cost");
   
   //pole do wyniku
   let calc_vmax = document.querySelector("#calc_vmax").innerHTML;

   //poziomy
   const gear = document.querySelector("#gear");
   const cooler = document.querySelector("#cooler");
   const chip = document.querySelector("#chip");

   switch(Number(package.value)){
      case 500:
         calc_vmax = Number(vmax) + 10;

         gear.innerHTML = '2 lvl';
         cooler.innerHTML = '2 lvl';
         chip.innerHTML = '2 lvl';
         break;
      case 1000:
         calc_vmax = Number(vmax) + 20;

         gear.innerHTML = '3 lvl';
         cooler.innerHTML = '3 lvl';
         chip.innerHTML = '3 lvl';
         break;
      default:
         calc_vmax = Number(vmax);

         gear.innerHTML = '1 lvl';
         cooler.innerHTML = '1 lvl';
         chip.innerHTML = '1 lvl';
   }

   //przekazywanie wyliczenień na ekran
   calc_vmax.innerHTML = calc_vmax;
   const result = Number(days.value) + Number(package.value);
   cost.innerHTML = result + "$";
}

days.addEventListener("change", work);
package.addEventListener("change", work);