// ======================================================
// MAIN DOCUMENT READY
// ======================================================
$(function() {

    // ======================================================
    // ANIMASI COUNTER STATISTIK (Native Observer + jQuery Animate)
    // ======================================================
    function animateCounter($element) {
        const target = parseInt($element.attr("data-target"));
        $({ countNum: 0 }).animate({
            countNum: target
        }, {
            duration: 2000,
            easing: 'swing',
            step: function() {
                $element.text(Math.floor(this.countNum));
            },
            complete: function() {
                $element.text(this.countNum);
            }
        });
    }

    const observerOptions = {
        threshold: 0.5,
        rootMargin: "0px",
    };

    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting && !$(entry.target).hasClass("counted")) {
                animateCounter($(entry.target));
                $(entry.target).addClass("counted");
            }
        });
    }, observerOptions);

    $(".stat-number").each(function() {
        counterObserver.observe(this);
    });

    // ======================================================
    // CHART.JS IMPLEMENTATION
    // ======================================================
    const $mainChartCanvas = $("#newMainChart");
    if ($mainChartCanvas.length) {
        const ctx = $mainChartCanvas[0].getContext('2d');
        const $chartTypeBtns = $(".chart-type-btn");

        const barChartData = {
            labels: ["Ibu Cerdas", "Ibu Mandiri", "Ibu Tangguh"],
            datasets: [{
                label: "Pre Test",
                data: [60.5, 55.5, 65],
                backgroundColor: ["rgba(231, 76, 60, 0.5)", "rgba(46, 204, 113, 0.5)", "rgba(142, 68, 173, 0.5)"],
                borderColor: ["rgba(231, 76, 60, 1)", "rgba(46, 204, 113, 1)", "rgba(142, 68, 173, 1)"],
                borderWidth: 2,
            }, {
                label: "Post Test",
                data: [95, 92.5, 95],
                backgroundColor: ["rgba(231, 76, 60, 1)", "rgba(46, 204, 113, 1)", "rgba(142, 68, 173, 1)"],
                borderColor: ["rgba(231, 76, 60, 1)", "rgba(46, 204, 113, 1)", "rgba(142, 68, 173, 1)"],
                borderWidth: 2,
            }],
        };

        const lineChartData = {
            labels: ["Pre Test", "Post Test"],
            datasets: [{
                label: "Ibu Cerdas",
                data: [60.5, 95],
                borderColor: "#e74c3c",
                backgroundColor: "rgba(231, 76, 60, 0.1)",
                fill: false,
                tension: 0.1,
                pointRadius: 6
            }, {
                label: "Ibu Mandiri",
                data: [55.5, 92.5],
                borderColor: "#2ecc71",
                backgroundColor: "rgba(46, 204, 113, 0.1)",
                fill: false,
                tension: 0.1,
                pointRadius: 6
            }, {
                label: "Ibu Tangguh",
                data: [65, 95],
                borderColor: "#8e44ad",
                backgroundColor: "rgba(142, 68, 173, 0.1)",
                fill: false,
                tension: 0.1,
                pointRadius: 6
            }]
        };

        const pieChartData = {
            labels: ["Cakap Usaha - Pre", "Cakap Usaha - Post", "Rawat Bumi - Pre", "Rawat Bumi - Post", "Sejahtera - Pre", "Sejahtera - Post"],
            datasets: [{
                label: "Nilai",
                data: [60.5, 95, 55.5, 92.5, 65, 95],
                backgroundColor: ["rgba(231, 76, 60, 0.7)", "rgba(231, 76, 60, 1)", "rgba(46, 204, 113, 0.7)", "rgba(46, 204, 113, 1)", "rgba(142, 68, 173, 0.7)", "rgba(142, 68, 173, 1)"],
                hoverOffset: 15
            }]
        };

        const optionsBase = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: "top", labels: { usePointStyle: true } }
            },
            scales: {
                y: { beginAtZero: true, max: 100, title: { display: true, text: "Nilai" } }
            }
        };

        let currentChart = new Chart(ctx, {
            type: "bar",
            data: barChartData,
            options: optionsBase
        });

        $chartTypeBtns.on("click", function() {
            const type = $(this).attr("data-type");
            $chartTypeBtns.removeClass("active");
            $(this).addClass("active");
            currentChart.destroy();

            let config = { type: "bar", data: barChartData, options: optionsBase };
            if (type === "line") config = { type: "line", data: lineChartData, options: optionsBase };
            else if (type === "pie") config = { type: "pie", data: pieChartData, options: { responsive: true } };

            currentChart = new Chart(ctx, config);
        });
    }

    // ======================================================
    // FORM PRESENSI (jQuery AJAX)
    // ======================================================
    const $attendanceForm = $("#attendanceForm");
    const scriptURL = "proses_presensi.php";

    if ($attendanceForm.length) {
        $attendanceForm.on("submit", function(e) {
            e.preventDefault();

            const name = $("#name").val();
            const address = $("#address").val();
            const program = $('input[name="program"]:checked').val();

            if (!name || !address || !program) {
                alert("⚠️ Mohon lengkapi semua field wajib.");
                return;
            }

            // Button loading state
            const $btn = $(this).find('button[type="submit"]');
            const originalText = $btn.html();
            $btn.html('<i class="fas fa-spinner fa-spin"></i> Mengirim...').prop('disabled', true);

            // FormData for Google Sheets
            const formData = new FormData(this);
            formData.set("NamaLengkap", name);
            formData.set("Alamat", address);
            formData.set("NamaKegiatan", program);
            formData.append("StatusKehadiran", "Hadir");

            $.ajax({
                url: scriptURL,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) { 
                     alert("✅ Presensi berhasil dikirim!");
                     $attendanceForm[0].reset();
                },
                error: function(xhr, status, error) {
                     // Handle potential CORS opaque response success
                     if(xhr.status === 0 || xhr.status === 200) {
                        alert("✅ Presensi berhasil dikirim!");
                        $attendanceForm[0].reset();
                     } else {
                        console.error(error);
                        alert("❌ Terjadi kesalahan jaringan!");
                     }
                },
                complete: function() {
                    $btn.html(originalText).prop('disabled', false);
                }
            });
        });
    }

    // ======================================================
    // SCROLL TO TOP
    // ======================================================
    const $scrollToTopBtn = $("#scrollToTop");
    if ($scrollToTopBtn.length) {
        $(window).on("scroll", function() {
            if ($(this).scrollTop() > 300) {
                $scrollToTopBtn.addClass("visible");
            } else {
                $scrollToTopBtn.removeClass("visible");
            }
        });

        $scrollToTopBtn.on("click", function() {
            $("html, body").animate({ scrollTop: 0 }, 800);
        });
    }

    // ======================================================
    // HEADER SCROLL EFFECT
    // ======================================================
    const $header = $("header");
    if ($header.length) {
        $(window).on("scroll", function() {
            if ($(this).scrollTop() > 100) $header.addClass("scrolled");
            else $header.removeClass("scrolled");
        });
    }

    // ======================================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ======================================================
    $('a[href^="#"]').on("click", function(e) {
        const targetId = $(this).attr("href");
        if (targetId.startsWith("#")) {
            e.preventDefault();
            const $target = $(targetId);
            if ($target.length) {
                $("html, body").animate({
                    scrollTop: $target.offset().top - 80
                }, 800, "swing");
            }
        }
    });

    // ======================================================
    // INITIALIZE AOS
    // ======================================================
    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 800,
            easing: "ease-out-cubic",
            once: true,
        });
    }

    // ======================================================
    // ZOOM GALERI (Simple Lightbox)
    // ======================================================
    const $galleryItems = $(".gallery-item");
    if ($galleryItems.length) {
        const $zoomModal = $('<div class="zoom-modal"><img class="zoom-image" src="" alt="Zoomed Image"></div>');
        $("body").append($zoomModal);
        const $zoomImage = $zoomModal.find(".zoom-image");

        $galleryItems.on("click", function(e) {
            e.preventDefault();
            const imgSrc = $(this).find("img").attr("src");
            if (imgSrc) {
                $zoomImage.attr("src", imgSrc);
                $zoomModal.addClass("active");
            }
        });

        $zoomModal.on("click", function(e) {
            if (e.target === this) {
                $(this).removeClass("active");
                setTimeout(() => $zoomImage.attr("src", ""), 300);
            }
        });

        $(document).on("keydown", function(e) {
            if (e.key === "Escape" && $zoomModal.hasClass("active")) {
                $zoomModal.removeClass("active");
            }
        });
    }

    // ======================================================
    // MOBILE BOTTOM NAV - SHOW/HIDE ON SCROLL
    // ======================================================
    const $mobileNav = $(".mobile-bottom-nav");
    if ($mobileNav.length) {
        let scrollThreshold = 100;

        $(window).on("scroll", function() {
            const currentScroll = $(this).scrollTop();
            if (currentScroll > scrollThreshold) {
                $mobileNav.addClass("visible");
            } else {
                 $mobileNav.removeClass("visible");
            }
        });
    }

    // ======================================================
    // ADMIN SWEETALERT2 INTEGRATION
    // ======================================================
    $(".btn-delete").on("click", function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5b21b6',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#fff',
            borderRadius: '12px',
            customClass: { confirmButton: 'btn btn-primary', cancelButton: 'btn btn-danger' }
        }).then((result) => {
            if (result.isConfirmed) window.location.href = href;
        });
    });

    $('.form-confirm').on('submit', function(e) {
        e.preventDefault();
        const form = this;
        
        Swal.fire({
            title: 'Simpan Data?',
            text: "Pastikan data yang dimasukkan sudah benar.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#5b21b6',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal',
            background: '#fff',
            borderRadius: '12px'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });

    // Check for URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const pesan = urlParams.get('pesan');

    if (pesan) {
        const msgConfig = {
            'sukses': { title: 'Berhasil!', text: 'Data berhasil ditambahkan.', icon: 'success' },
            'update': { title: 'Berhasil!', text: 'Data berhasil diperbarui.', icon: 'success' },
            'hapus': { title: 'Berhasil!', text: 'Data berhasil dihapus.', icon: 'success' },
            'gagal': { title: 'Gagal!', text: 'Terjadi kesalahan.', icon: 'error' }
        };

        if (msgConfig[pesan]) {
            Swal.fire({
                ...msgConfig[pesan],
                confirmButtonColor: '#5b21b6',
                timer: 3000,
                timerProgressBar: true
            });
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }

});
