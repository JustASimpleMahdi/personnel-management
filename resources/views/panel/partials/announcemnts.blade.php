<div class="announcement-section">
    <div class="section-title">
        اعلان‌ها:
    </div>

    @if($announcements->isNotEmpty())
        <div class="slider-container" id="sliderContainer">
            <div>
                <div class="slider-track" id="sliderTrack">
                    @foreach($announcements as $announcement)
                        <div class="announcement-box">
                            <div class="announcement-title">{{ $announcement->title }}</div>
                            <div class="announcement-desc">{{ $announcement->text }}</div>
                        </div>

                    @endforeach
                </div>
            </div>

            <!-- دکمه‌های ناوبری (چپ و راست) با آیکون SVG -->
            <div class="slider-nav nav-prev" id="prevBtn">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </div>
            <div class="slider-nav nav-next" id="nextBtn">
                <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </div>
        </div>

        <!-- نقاط اسلایدر -->
        <div class="slider-dots" id="dotsContainer"></div>
    @else
        <div class="announcement-box">
            <div class="announcement-desc" style="text-align: center">هیچ اعلانی وجود ندارد.</div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        (function () {
            // ---- عناصر DOM ----
            const track = document.getElementById('sliderTrack');
            const container = document.getElementById('sliderContainer');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const dotsContainer = document.getElementById('dotsContainer');

            // ---- متغیرهای اسلایدر ----
            let slides = [];
            let currentIndex = 0;
            let totalSlides = 0;
            let preventClick = false;
            let isDraggingTouch = false;
            let startDragTranslate = 0;
            let dragDistance = 0;
            let startX = 0;

            // ---- مقداردهی اولیه ----
            function initSlides() {
                const slideElements = Array.from(track.children);
                if (slideElements.length === 0) return;
                slides = slideElements;
                totalSlides = slides.length;
                updateSliderPosition(false);
                renderDots();
                updateNavButtons();
            }

            // ایجاد نقاط راهنما
            function renderDots() {
                if (!dotsContainer) return;
                dotsContainer.innerHTML = '';
                for (let i = 0; i < totalSlides; i++) {
                    const dot = document.createElement('div');
                    dot.classList.add('dot');
                    if (i === currentIndex) dot.classList.add('active');
                    dot.addEventListener('click', (e) => {
                        e.stopPropagation();
                        if (i === currentIndex) return;
                        goToSlide(i, true);
                    });
                    dotsContainer.appendChild(dot);
                }
            }

            // به روزرسانی دات‌ها
            function updateDots() {
                const allDots = document.querySelectorAll('.dot');
                allDots.forEach((dot, idx) => {
                    if (idx === currentIndex) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }

            // بروزرسانی دکمه‌ها
            function updateNavButtons() {
                if (prevBtn && nextBtn) {
                    if (currentIndex === 0) {
                        prevBtn.classList.add('nav-disabled');
                    } else {
                        prevBtn.classList.remove('nav-disabled');
                    }
                    if (currentIndex === totalSlides - 1) {
                        nextBtn.classList.add('nav-disabled');
                    } else {
                        nextBtn.classList.remove('nav-disabled');
                    }
                }
            }

            // محاسبه عرض هر اسلاید
            function getSlideWidth() {
                if (!container) return 0;
                return container.clientWidth;
            }

            // تنظیم موقعیت ترک برای RTL
            function updateSliderPosition(useAnimation = true) {
                if (!track) return;
                const slideWidth = getSlideWidth();
                if (slideWidth === 0) return;
                // در RTL، اسلاید اول در راست است، بنابراین transform باید منفی باشد
                const newTranslate = (currentIndex * slideWidth);
                if (useAnimation) {
                    track.style.transition = 'transform 0.35s cubic-bezier(0.2, 0.9, 0.4, 1.1)';
                } else {
                    track.style.transition = 'none';
                }
                track.style.transform = `translateX(${newTranslate}px)`;
                if (!useAnimation) {
                    void track.offsetHeight;
                    track.style.transition = '';
                }
            }

            // رفتن به اسلاید مشخص شده
            function goToSlide(index, smooth = true) {
                if (index < 0) index = 0;
                if (index >= totalSlides) index = totalSlides - 1;
                if (index === currentIndex) return;
                currentIndex = index;
                updateSliderPosition(smooth);
                updateDots();
                updateNavButtons();
            }

            // بعدی و قبلی
            function nextSlide() {
                if (currentIndex + 1 < totalSlides) {
                    goToSlide(currentIndex + 1, true);
                }
            }

            function prevSlide() {
                if (currentIndex - 1 >= 0) {
                    goToSlide(currentIndex - 1, true);
                }
            }

            // دریافت مقدار translate فعلی
            function getCurrentTranslateValue() {
                if (!track) return 0;
                const style = window.getComputedStyle(track);
                const transform = style.transform;
                if (transform === 'none') return 0;
                const matrix = transform.match(/matrix.*\((.+)\)/);
                if (matrix) {
                    const values = matrix[1].split(', ');
                    if (values.length === 6) {
                        return parseFloat(values[4]);
                    } else if (values.length === 16) {
                        return parseFloat(values[12]);
                    }
                    return parseFloat(values[4] || 0);
                }
                return 0;
            }

            // شروع حرکت لمسی/ماوس
            function onDragStart(clientX) {
                if (totalSlides === 0) return;
                isDraggingTouch = true;
                preventClick = true;
                startDragTranslate = getCurrentTranslateValue();
                startX = clientX;
                track.style.transition = 'none';
                document.body.style.userSelect = 'none';
            }

            function onDragMove(clientX) {
                if (!isDraggingTouch) return;
                const deltaX = clientX - startX;
                let newTranslate = startDragTranslate + deltaX;
                const slideWidth = getSlideWidth();
                const minTranslate = (totalSlides - 1) * slideWidth;
                const maxTranslate = 0;

                if (newTranslate < maxTranslate) {
                    newTranslate = maxTranslate + (newTranslate - maxTranslate) * 0.3;
                } else if (newTranslate > minTranslate) {
                    newTranslate = minTranslate + (newTranslate - minTranslate) * 0.3;
                }
                track.style.transform = `translateX(${newTranslate}px)`;
                dragDistance = deltaX;
            }

            function onDragEnd() {
                if (!isDraggingTouch) {
                    document.body.style.userSelect = '';
                    return;
                }
                isDraggingTouch = false;
                document.body.style.userSelect = '';
                const slideWidth = getSlideWidth();
                if (slideWidth === 0) return;
                const moved = dragDistance;
                const threshold = slideWidth * 0.25;
                let direction = 0;

                if (Math.abs(moved) > threshold) {
                    // در RTL، حرکت به چپ (مقدار منفی) به معنای اسلاید بعدی است
                    if (moved > 0) {
                        direction = 1; // next
                    } else if (moved < 0) {
                        direction = -1; // prev
                    }
                }

                track.style.transition = 'transform 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1)';

                if (direction !== 0) {
                    let newIndex = currentIndex + direction;
                    if (newIndex < 0) newIndex = 0;
                    if (newIndex >= totalSlides) newIndex = totalSlides - 1;
                    if (newIndex !== currentIndex) {
                        currentIndex = newIndex;
                        updateSliderPosition(true);
                        updateDots();
                        updateNavButtons();
                    } else {
                        updateSliderPosition(true);
                    }
                } else {
                    updateSliderPosition(true);
                }

                dragDistance = 0;
                startDragTranslate = 0;
                setTimeout(() => {
                    preventClick = false;
                }, 100);
            }

            // رویدادهای لمسی
            function handleTouchStart(e) {
                if (totalSlides <= 1) return;
                e.preventDefault();
                const touch = e.touches[0];
                onDragStart(touch.clientX);
            }

            function handleTouchMove(e) {
                if (!isDraggingTouch || totalSlides <= 1) return;
                const touch = e.touches[0];
                onDragMove(touch.clientX);
                if (Math.abs(dragDistance) > 10) {
                    e.preventDefault();
                }
            }

            function handleTouchEnd(e) {
                if (totalSlides <= 1) {
                    isDraggingTouch = false;
                    return;
                }
                onDragEnd();
            }

            // رویدادهای ماوس
            function handleMouseDown(e) {
                if (totalSlides <= 1) return;
                e.preventDefault();
                onDragStart(e.clientX);
                window.addEventListener('mousemove', handleMouseMove);
                window.addEventListener('mouseup', handleMouseUp);
            }

            function handleMouseMove(e) {
                if (!isDraggingTouch) return;
                onDragMove(e.clientX);
            }

            function handleMouseUp(e) {
                onDragEnd();
                window.removeEventListener('mousemove', handleMouseMove);
                window.removeEventListener('mouseup', handleMouseUp);
            }

            function handleResize() {
                if (!track) return;
                updateSliderPosition(false);
            }

            // اتصال رویدادها
            function bindEvents() {
                if (container) {
                    container.addEventListener('touchstart', handleTouchStart, {passive: false});
                    container.addEventListener('touchmove', handleTouchMove, {passive: false});
                    container.addEventListener('touchend', handleTouchEnd);
                    container.addEventListener('touchcancel', handleTouchEnd);
                    container.addEventListener('mousedown', handleMouseDown);
                }
                if (prevBtn) {
                    prevBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        // if (preventClick) return;
                        prevSlide();
                    });
                }
                if (nextBtn) {
                    nextBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        // if (preventClick) return;
                        nextSlide();
                    });
                }
                window.addEventListener('resize', () => {
                    handleResize();
                });
            }

            // راه‌اندازی
            function setupSlider() {
                initSlides();
                bindEvents();
                if (totalSlides > 0) {
                    updateSliderPosition(false);
                }
            }

            setupSlider();
        })();
    </script>
@endpush
