/* 
  === Javascript For Mitra Page ===
*/

/* Home / Volunteer Management */
// Sidebar
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleSidebar = document.getElementById("toggleSidebar");
    const overlay = document.getElementById("overlay");

    // Open sidebar
    const openSidebar = () => {
        sidebar.classList.remove("-translate-x-full");
        sidebar.classList.add("translate-x-0");
        overlay.classList.remove("hidden", "opacity-0");
        overlay.classList.add("opacity-50");
    };

    // Close sidebar
    const closeSidebar = () => {
        sidebar.classList.remove("translate-x-0");
        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("opacity-0");
        overlay.classList.add("hidden");
    };

    toggleSidebar.addEventListener("click", openSidebar);
    overlay.addEventListener("click", closeSidebar);
});

// Detail Volunteer
document.addEventListener("DOMContentLoaded", function () {
    const overlay = document.getElementById("overlay");
    const detailVolunteer = document.getElementById("detailVolunteer");
    const tableBody = document.getElementById("tableBody");
    const closeDetailVolunteerMitraButton = document.getElementById(
        "closeDetailVolunteerMitraBtn"
    );

    // Function to show the detail and overlay
    const showDetail = () => {
        detailVolunteer.classList.remove("translate-x-full");
        detailVolunteer.classList.add("translate-x-0");
        overlay.classList.remove("opacity-0", "hidden");
        overlay.classList.add("opacity-100");
    };

    // Function to hide the detail and overlay
    const hideDetail = () => {
        detailVolunteer.classList.remove("translate-x-0");
        detailVolunteer.classList.add("translate-x-full");
        overlay.classList.remove("opacity-100");
        overlay.classList.add("opacity-0");
        setTimeout(() => {
            overlay.classList.add("hidden");
        }, 500); // Match the duration of the transition
    };

    // Add event listener to each row
    tableBody.querySelectorAll("tr").forEach((row) => {
        row.addEventListener("click", showDetail);
    });

    // Add event listener to close button and overlay
    closeDetailVolunteerMitraButton.addEventListener("click", hideDetail);
    overlay.addEventListener("click", hideDetail);
});

// LIST DAN DETAIL KEGIATAN
document.addEventListener("DOMContentLoaded", () => {
    const detailContainer = document.getElementById("detailVolunteer");
    const editButton = document.getElementById("editBtn");
    const addRequirementButton = document.getElementById("addRequirementBtn");
    const addBenefitButton = document.getElementById("addBenefitBtn");

    document.querySelectorAll(".activity").forEach((card) => {
        card.addEventListener("click", () => {
            // Ambil data dari atribut data-*
            const id_keg = card.dataset.idKegiatan;
            const namaKegiatan = card.dataset.namaKegiatan;
            const namaMitra = card.dataset.namaMitra;
            const lokasiKegiatan = card.dataset.lokasiKegiatan;
            const logo = card.dataset.logo;
            const sistemKegiatan = card.dataset.sistemKegiatan;
            const pendaftarCount = card.dataset.pendaftarCount;
            const deskripsiKegiatan = card.dataset.deskripsiKegiatan;
            const namaKriteria = card.dataset.namaKriteria;
            const namaBenefit = card.dataset.namaBenefit;
            const tglKegiatan = card.dataset.tglKegiatan;
            const tglPenutupan = card.dataset.tglPenutupan;

            // Tampilkan data di bagian detail
            detailContainer.querySelector(".namaKegiatan").textContent =
                namaKegiatan;
            detailContainer.querySelector(".namaMitra").textContent = namaMitra;
            detailContainer.querySelector(".lokasiKegiatan").textContent =
                lokasiKegiatan;
            detailContainer.querySelector("img").src = logo;
            detailContainer.querySelector(".sistemKegiatan").textContent =
                sistemKegiatan;
            detailContainer.querySelector(".pendaftarCount").textContent =
                pendaftarCount;
            detailContainer.querySelector(".deskripsiKegiatan").textContent =
                deskripsiKegiatan;
            detailContainer.querySelector(".tglKegiatan").textContent =
                tglKegiatan;
            detailContainer.querySelector(".tglPenutupan").textContent =
                tglPenutupan;

            const kriteriaContainer =
                detailContainer.querySelector(".kriteriaContainer"); // Ambil container kriteria
            kriteriaContainer.innerHTML = ""; // Kosongkan container sebelum menambah elemen baru

            if (namaKriteria && namaKriteria.trim() !== "") {
                // Jika data kriteria ada
                const kriteriaArray = namaKriteria.split(","); // Pisahkan berdasarkan koma
                kriteriaArray.forEach((kriteria) => {
                    const kriteriaSpan = document.createElement("span");
                    kriteriaSpan.classList.add(
                        "namaKriteria",
                        "px-4",
                        "py-1",
                        "bg-sky-200",
                        "text-sm",
                        "rounded-lg"
                    );
                    kriteriaSpan.textContent = kriteria.trim(); // Hapus spasi berlebih
                    kriteriaContainer.appendChild(kriteriaSpan);
                });
            } else {
                // Jika data kriteria kosong, tampilkan pesan
                const emptyMessage = document.createElement("span");
                emptyMessage.classList.add(
                    "namaKriteria",
                    "px-4",
                    "py-1",
                    "bg-red-200",
                    "text-sm",
                    "rounded-lg"
                );
                emptyMessage.textContent = "Mitra belum mengisikan data";
                kriteriaContainer.appendChild(emptyMessage);
            }

            const benefitContainer =
                detailContainer.querySelector(".benefitContainer"); // Ambil container kriteria
            benefitContainer.innerHTML = ""; // Kosongkan container sebelum menambah elemen baru

            if (namaBenefit && namaBenefit.trim() !== "") {
                // Jika data kriteria ada
                const benefitArray = namaBenefit.split(","); // Pisahkan berdasarkan koma
                benefitArray.forEach((benefit) => {
                    const benefitSpan = document.createElement("span");
                    benefitSpan.classList.add(
                        "namaBenefit",
                        "px-4",
                        "py-1",
                        "bg-sky-200",
                        "text-sm",
                        "rounded-lg"
                    );
                    benefitSpan.textContent = benefit.trim(); // Hapus spasi berlebih
                    benefitContainer.appendChild(benefitSpan);
                });
            } else {
                // Jika data kriteria kosong, tampilkan pesan
                const emptyMessage = document.createElement("span");
                emptyMessage.classList.add(
                    "namaBenefit",
                    "px-4",
                    "py-1",
                    "bg-red-200",
                    "text-sm",
                    "rounded-lg"
                );
                emptyMessage.textContent = "Mitra belum mengisikan data";
                benefitContainer.appendChild(emptyMessage);
            }

            const id = detailContainer.dataset.idMitra;
            editButton.href = `/mitra/edit-kegiatan/${id}/${id_keg}`;

            addRequirementButton.href = `/mitra/add-kriteria-kegiatan/${id}/${id_keg}`;
            addBenefitButton.href = `/mitra/add-benefit-kegiatan/${id}/${id_keg}`;
        });
    });
});

/* Registration Manegement */
// APPLICANT PROFILE
document.addEventListener("DOMContentLoaded", () => {
    const tabRegistrationContainer = document.getElementById(
        "tabRegistrationContainer"
    );
    const buttons = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll(".tab-content");

    const activateTab = (targetId) => {
        // Reset all buttons and hide all content
        buttons.forEach((btn) => {
            btn.classList.remove("text-sky-500", "after:w-full");
            btn.classList.add("text-gray-500");
        });
        contents.forEach((content) => content.classList.add("hidden"));

        // Activate the target button and content
        const targetButton = [...buttons].find(
            (btn) => btn.dataset.target === targetId
        );
        const targetContent = document.getElementById(targetId);

        targetButton.classList.add("text-sky-500", "after:w-full");
        targetButton.classList.remove("text-gray-500");
        targetContent.classList.remove("hidden");
    };

    // Initialize with applicant profile active
    activateTab("applicantProfileContent");

    // Event delegation for button clicks
    tabRegistrationContainer.addEventListener("click", (event) => {
        const targetButton = event.target.closest(".tab-btn");
        if (!targetButton) return; // Ignore clicks outside buttons

        const targetContentId = targetButton.dataset.target;
        activateTab(targetContentId);
    });
});

// HIRING PROGRES
document.addEventListener("DOMContentLoaded", () => {
    const currentStageContainer = document.getElementById(
        "currentStageContainer"
    );
    const currentStage = document.querySelectorAll(".current-stage-button");
    const currentStageContent = document.querySelectorAll(
        ".current-stage-content"
    );

    const activateTab = (targetId) => {
        // Reset all buttons and hide all content
        currentStage.forEach((btn) => {
            btn.classList.remove("text-sky-500", "after:w-full");
            btn.classList.add("text-gray-500");
        });
        currentStageContent.forEach((content) =>
            content.classList.add("hidden")
        );

        // Activate the target button and content
        const targetButton = [...currentStage].find(
            (btn) => btn.dataset.target === targetId
        );
        const targetContent = document.getElementById(targetId);

        targetButton.classList.add("text-sky-500", "after:w-full");
        targetButton.classList.remove("text-gray-500");
        targetContent.classList.remove("hidden");
    };

    // Initialize with applicant profile active
    activateTab("inReview");

    // Event delegation for button clicks
    currentStageContainer.addEventListener("click", (event) => {
        const targetButton = event.target.closest(".current-stage-button");
        if (!targetButton) return; // Ignore clicks outside buttons

        const targetContentId = targetButton.dataset.target;
        activateTab(targetContentId);
    });
});

// copy email
document.getElementById("copy-button").addEventListener("click", function () {
    // Pilih elemen teks yang akan disalin
    var textToCopy = document.getElementById("text-to-copy").innerText;

    // Gunakan API Clipboard untuk menyalin teks ke clipboard
    navigator.clipboard
        .writeText(textToCopy)
        .then(function () {
            alert("Teks berhasil disalin ke clipboard!");
        })
        .catch(function (error) {
            alert("Gagal menyalin teks: " + error);
        });
});

// short text description
document
    .getElementById("btn-more-desc")
    .addEventListener("click", function (event) {
        const element = event.target;
        const parent = element.parentElement;
        const shortDesc = parent.querySelector(".short-desc");
        const moreDesc = parent.querySelector(".more-desc");

        if (moreDesc.classList.contains("hidden")) {
            shortDesc.classList.add("hidden");
            moreDesc.classList.remove("hidden");
            element.textContent = "Less";
        } else {
            shortDesc.classList.remove("hidden");
            moreDesc.classList.add("hidden");
            element.textContent = "More";
        }
    });

// short text description experience
document
    .getElementById("btn-more-desc-exp")
    .addEventListener("click", function (event) {
        const element = event.target;
        const parent = element.parentElement;
        const shortDesc = parent.querySelector(".short-desc");
        const moreDesc = parent.querySelector(".more-desc");

        if (moreDesc.classList.contains("hidden")) {
            shortDesc.classList.add("hidden");
            moreDesc.classList.remove("hidden");
            element.textContent = "Less";
        } else {
            shortDesc.classList.remove("hidden");
            moreDesc.classList.add("hidden");
            element.textContent = "More";
        }
    });
