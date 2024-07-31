<style>
    .active-nav {
      color: #319F43 !important; 
      font-weight: 500
    }
  </style>

<x-base-layout>
    <header class="w-full bg-white fixed top-0 left-0 z-1">
        <div class="container mx-auto flex justify-between items-center" style="height: 80px !important">
            <div class="flex items-center">
                <img class="w-32 h-32 object-contain" src="{{ asset('images/logo_with_text.png') }}" alt="NutriMotion" />
            </div>
            <nav class="flex space-x-8 text-xs">
                <a href="#home" class="nav-link text-[#A8AAAE] hover:text-[#319F43]">Home</a>
                <a href="#features" class="nav-link text-[#A8AAAE] hover:text-[#319F43]">Features</a>
                <a href="#get-app" class="nav-link text-[#A8AAAE] hover:text-[#319F43]">Get App</a>
            </nav>
            <div class="flex items-center justify-end">
                <span class="text-xs text-[#1E1E1E] mr-2">Available <strong>in</strong></span>
                <div class="flex items-center justify-center border rounded-md w-6 h-6 cursor-pointer">
                    <img class="w-3 h-3 object-contain" src="{{ asset('images/google_pay.png') }}" alt="Google Play">
                </div>
            </div>
        </div>
    </header>
    

    <main class="w-full bg-white">
      <section id="home" class="-z-0 h-screen bg-cover bg-center bg-no-repeat flex flex-col items-center justify-center" style="background-image: url('{{ asset('images/pattern.png') }}');">
          <div class="block text-center" style="margin-top: 630px !important">
              <h1 class="text-4xl font-normal text-[#1E1E1E]">Ketahui <span class="font-bold">Nutrisi</span> Makananmu dan Kontrol <br> Asupan dengan <span class="font-bold">Mudah</span>.</h1>
              <p class="mt-5 text-[#9E9E9E] w-4/6 mx-auto text-base">Dapatkan <span class="font-semibold underline">informasi detail</span> tentang karbohidrat, protein, dan lemak dari makanan yang kamu konsumsi.</p>
              <a href="#features" class="nav-link flex items-center space-x-2 justify-center mt-5">
                  <p class="text-[#4CB050] text-xs+ font-semibold">Explore Now</p>
                  <img class="h-4 w-4 object-contain" src="{{ asset('images/down_arrow.png') }}" alt="Down Arrow">
              </a>                
          </div>
  
          <div class="mt-5">
              <img class="w-1/3 mx-auto" src="{{ asset('images/dashboard_mockup.png') }}" alt="Device Image">
          </div>
      </section>
      
      <section id="features" class="relative h-screen flex items-center justify-center z-0">
          <div class="w-full bg-black bg-cover bg-center bg-no-repeat flex flex-col items-center justify-center" style="background-image: url('{{ asset('images/pattern.png') }}'); height: 38rem;">
              <div class="text-center py-12 mt-72">
                  <h1 class="text-3xl text-white md:text-3xl font-semibold">Pantau, Kendalikan, <br><span class="text-green-500">Bergerak</span></h1>
              </div>
              <div class="flex flex-col md:flex-row items-center justify-center space-y-8 md:space-y-0 md:space-x-8 px-4">
                  <div class="bg-white px-20 pb-8 rounded-3xl">
                      <div class="flex flex-col items-center">
                          <p class="my-8 text-[#1E1E1E] text-sm text-center font-semibold">Informasi Gizi Terperinci</p>
                          <img src="{{ asset('images/gizi_mockup.png') }}" alt="Informasi Gizi Terperinci" class="w-52">
                      </div>
                  </div>
                  <div class="bg-white px-20 pb-8 rounded-3xl">
                      <div class="flex flex-col items-center">
                          <p class="my-8 text-[#1E1E1E] text-sm text-center font-semibold">Kontrol Asupan Dengan Mudah</p>
                          <img src="{{ asset('images/asupan_mockup.png') }}" alt="Kontrol Asupan Dengan Mudah" class="w-52">
                      </div>
                  </div>
                  <div class="bg-white px-20 pb-8 rounded-3xl">
                      <div class="flex flex-col items-center">
                          <p class="my-8 text-[#1E1E1E] text-sm text-center font-semibold">Scan Barcode</p>
                          <img src="{{ asset('images/scan_mockup.png') }}" alt="Scan Barcode" class="w-52">
                      </div>
                  </div>
              </div>
          </div>
      </section>
      
      <section id="get-app" class="flex items-center justify-center w-full relative mt-80">
          <div class="w-full h-auto bg-white flex flex-col items-center justify-center">
              <h1 class="w-1/2 text-2xl text-center font-semibold text-[#1E1E1E]">Pantau aktivitas harian Anda, tetapkan tujuan kebugaran, dan tetap termotivasi untuk mencapai gaya hidup yang lebih sehat.</h1>
              <a href="#" class="mt-6 flex items-center border rounded-lg px-4 py-2 bg-white hover:shadow-lg transition-shadow">
                  <img src="{{ asset('images/google_pay.png') }}" alt="Google Play Logo" class="w-8 h-8 mr-3">
                  <div class="flex flex-col">
                      <span class="text-xs text-[#A1A1A1]">Dapatkan di</span>
                      <span class="text-lg font-semibold text-[#1E1E1E]">Google Play</span>
                  </div>
              </a>
          
              <div class="mt-5 relative w-1/2 mx-auto" style="height: 500px; overflow: hidden;">
                  <img class="absolute top-0 w-full" src="{{ asset('images/getapps_mockup.png') }}" alt="Device Image">
              </div>
          </div>
      </section>
      
      <footer class="w-full relative h-20 flex items-center justify-between bg-white z-20 px-6 py-6">
          <p class="text-sm text-[#1E1E1E] leading-tight font-semibold">Pantau, <br>Kendalikan, <br> <span class="text-[#319F43] italic">Bergerak</span></p>
          <p class="mt-4 text-slate-400 justify-end" style="font-size: 10px">Hak cipta © 2024 NutriMotion. Seluruh hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>
    
    </main>
    
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const sections = document.querySelectorAll('section');
          const navLinks = document.querySelectorAll('.nav-link');
    
          function changeLinkState() {
            let index = sections.length;
    
            while (--index && window.scrollY + 50 < sections[index].offsetTop) {}
            
            navLinks.forEach((link) => link.classList.remove('active-nav'));
            navLinks[index].classList.add('active-nav');
          }
    
          changeLinkState();
          window.addEventListener('scroll', changeLinkState);
    
          navLinks.forEach((link) => {
            link.addEventListener('click', function (e) {
              e.preventDefault();
              const targetId = e.currentTarget.getAttribute('href').substring(1);
              document.getElementById(targetId).scrollIntoView({ behavior: 'smooth' });
            });
          });
        });
      </script>
</x-base-layout>
