/*==========================================
            FAQ ACCORDION
==========================================*/

const faqItems = document.querySelectorAll(".faq-item");

faqItems.forEach(item => {

    const question = item.querySelector(".faq-question");

    question.addEventListener("click", () => {

        faqItems.forEach(faq => {

            if(faq !== item){

                faq.classList.remove("active");

            }

        });

        item.classList.toggle("active");

    });

}); 

AOS.init({

duration:1000,

offset:120,

once:true,

easing:"ease"

}); 

document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        counter.innerText = '0';
        
        const updateCounter = () => {
            const target = +counter.getAttribute('data-target');
            const c = +counter.innerText;
            
            // Animasyon hızı
            const increment = target / 100; 
            
            if(c < target) {
                if (target % 1 !== 0) {
                    counter.innerText = `${(c + increment).toFixed(1)}`;
                } else {
                    counter.innerText = `${Math.ceil(c + increment)}`;
                }
                setTimeout(updateCounter, 15);
            } else {
                counter.innerText = target;
                
                // TAM BURAYA: Sayma işlemi bittiğinde animate sınıfını kaldırıyoruz
                setTimeout(() => {
                    counter.classList.remove("animate");
                }, 550);
            }
        };
        
        // Sayaç başlamadan hemen önce sınıfı ekliyoruz
        counter.classList.add("animate");
        
        updateCounter();
    });
});

/*==========================================
        STICKY HEADER
==========================================*/

document.addEventListener("DOMContentLoaded", () => {
    const header = document.getElementById("header");

    // Güvenlik kontrolü: Sayfada #header id'li element varsa çalıştırır
    if (header) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 80) {
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }
        });
    }
});

/*==========================================
        BACK TO TOP
==========================================*/

document.addEventListener("DOMContentLoaded", () => {
    const backTop = document.getElementById("backToTop");

    // Güvenlik Kontrolü: Buton HTML içinde varsa kodları çalıştırır
    if (backTop) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 500) {
                backTop.classList.add("show");
            } else {
                backTop.classList.remove("show");
            }
        });

        backTop.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    }
}); 

/*==========================================
        ACTIVE MENU
==========================================*/

const sections = document.querySelectorAll("section[id]");
const navLinks = document.querySelectorAll(".nav__link");

window.addEventListener("scroll", () => {

    let current = "";

    sections.forEach(section => {

        const sectionTop = section.offsetTop - 140;

        const sectionHeight = section.offsetHeight;

        if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
            current = section.getAttribute("id");
        }

    });

    navLinks.forEach(link => {

        link.classList.remove("active");

        if(link.getAttribute("href")==="#" + current){

            link.classList.add("active");

        }

    });

});

