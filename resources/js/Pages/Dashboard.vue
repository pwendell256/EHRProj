<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    user: Number
})
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <main class="flex-1 mt-8">

            <!-- Pediatric Header Section -->
            <div
                class="relative overflow-hidden rounded-lg border border-gray-200 bg-gradient-to-br from-green-100 to-blue-100 p-6 shadow-md">
                <!-- Menu Icon (Optional, can be removed if already in layout) -->
                <div class="absolute left-4 top-4">
                    <i class="icon-menu h-6 w-6 text-gray-600"></i>
                </div>

                <!-- Logo -->
                <div class="flex justify-center">
                    <div class="h-40 w-40 rounded-full bg-white shadow-lg flex items-center justify-center">
                        <img src="../Images/LOGO.png" alt="Hospital Logo" class="h-28 w-28 object-contain" />
                    </div>
                </div>

                <!-- Hospital Name -->
                <div class="mt-4 flex justify-center">
                    <div
                        class="rounded-md border border-gray-400 bg-white px-6 py-2 text-center text-xl font-semibold text-gray-800">
                        FEU Fortis Medical Center
                    </div>
                </div>

                <!-- Pedia Ward Text -->
                <div class="mt-2 text-center text-lg font-medium text-purple-800">
                    Pedia Ward
                </div>

                <!-- Scroll Down Hint -->
                <div class="mt-4 flex justify-center">
                    <div class="animate-bounce text-sm text-gray-500">
                        ↓ scroll down
                    </div>
                </div>
            </div>


            <div class="space-y-8 mt-4">
                <!-- Static Greeting Section -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Welcome, Dr. Johnson</h2>
                            <div class="mt-1 flex items-center text-sm text-gray-500">
                                <i class="icon-calendar mr-2 h-4 w-4"></i>
                                Monday, January 1, 2023
                            </div>
                        </div>
                        <div class="rounded-lg bg-blue-50 px-4 py-2">
                            <p class="text-sm font-medium text-blue-700">You have 8 appointments today</p>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="rounded-md bg-blue-50 p-3">
                            <p class="text-sm font-medium text-gray-700">Today's Patients</p>
                            <p class="text-xl font-bold text-blue-700">{{ user }}</p>
                        </div>
                        <div class="rounded-md bg-green-50 p-3">
                            <p class="text-sm font-medium text-gray-700">Scheduled Surgeries</p>
                            <p class="text-xl font-bold text-green-700">3</p>
                        </div>
                        <div class="rounded-md bg-amber-50 p-3">
                            <p class="text-sm font-medium text-gray-700">Lab Results Pending</p>
                            <p class="text-xl font-bold text-amber-700">7</p>
                        </div>
                        <div class="rounded-md bg-purple-50 p-3">
                            <p class="text-sm font-medium text-gray-700">Staff on Duty</p>
                            <p class="text-xl font-bold text-purple-700">42</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->




                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">


                    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="flex flex-row items-center justify-between p-4 pb-2">
                            <h3 class="text-sm font-medium text-gray-900">Total Patients</h3>
                            <button class="rounded-full p-1 hover:bg-gray-100">
                                <i class="icon-more-horizontal h-4 w-4 text-gray-500"></i>
                                <span class="sr-only">Menu</span>
                            </button>
                        </div>
                        <div class="px-4 pb-4">
                            <div class="text-2xl font-bold text-gray-900">5,715</div>
                            <div class="mt-1 flex items-center text-xs text-gray-500">
                                <i class="icon-arrow-up-right mr-1 h-3 w-3 text-emerald-500"></i>
                                <span class="font-medium text-emerald-500">+10.45%</span>
                            </div>
                            <div class="mt-2 text-xs text-gray-500">+500 patients in the last 7 days</div>
                        </div>
                    </div>
                    <!-- Overall Visitors -->
                    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="flex flex-row items-center justify-between p-4 pb-2">
                            <h3 class="text-sm font-medium text-gray-900">Overall Visitors</h3>
                            <button class="rounded-full p-1 hover:bg-gray-100">
                                <i class="icon-more-horizontal h-4 w-4 text-gray-500"></i>
                                <span class="sr-only">Menu</span>
                            </button>
                        </div>
                        <div class="px-4 pb-4">
                            <div class="text-2xl font-bold text-gray-900">10,525</div>
                            <div class="mt-1 flex items-center text-xs text-gray-500">
                                <i class="icon-arrow-up-right mr-1 h-3 w-3 text-emerald-500"></i>
                                <span class="font-medium text-emerald-500">35.2%</span>
                                <span class="ml-1">from 5,567 to 7,525 (7d)</span>
                            </div>
                            <div class="mt-2 text-xs text-gray-500">1,345 today</div>
                        </div>
                    </div>

                    <!-- Surgery -->
                    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="flex flex-row items-center justify-between p-4 pb-2">
                            <h3 class="text-sm font-medium text-gray-900">Surgery</h3>
                            <button class="rounded-full p-1 hover:bg-gray-100">
                                <i class="icon-more-horizontal h-4 w-4 text-gray-500"></i>
                                <span class="sr-only">Menu</span>
                            </button>
                        </div>
                        <div class="px-4 pb-4">
                            <div class="text-2xl font-bold text-gray-900">523</div>
                            <div class="mt-1 flex items-center text-xs text-gray-500">
                                <i class="icon-arrow-up-right mr-1 h-3 w-3 text-emerald-500"></i>
                                <span class="font-medium text-emerald-500">+16%</span>
                                <span class="ml-1">from 10.2% to 16.1% (7d)</span>
                            </div>
                            <div class="mt-2 text-xs text-gray-500">48 today</div>
                        </div>
                    </div>

                    <!-- Overall Room -->
                    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="flex flex-row items-center justify-between p-4 pb-2">
                            <h3 class="text-sm font-medium text-gray-900">Overall Rooms</h3>
                            <button class="rounded-full p-1 hover:bg-gray-100">
                                <i class="icon-more-horizontal h-4 w-4 text-gray-500"></i>
                                <span class="sr-only">Menu</span>
                            </button>
                        </div>
                        <div class="px-4 pb-4">
                            <div class="text-2xl font-bold text-gray-900">221</div>
                            <div class="mt-1 flex items-center text-xs text-gray-500">
                                <i class="icon-arrow-up-right mr-1 h-3 w-3 text-emerald-500"></i>
                                <span class="font-medium text-emerald-500">+16%</span>
                            </div>
                            <div class="mt-2 grid grid-cols-2 gap-2 text-xs text-gray-500">
                                <div class="flex items-center">
                                    <div class="mr-1 h-2 w-2 rounded-full bg-blue-600"></div>
                                    General: 110
                                </div>
                                <div class="flex items-center">
                                    <div class="mr-1 h-2 w-2 rounded-full bg-indigo-500"></div>
                                    Private: 111
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mission, Vision, About Us Section -->
                <section class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6 ">

                    <!-- Left Column: Mission & Vision -->
                    <div class="space-y-6">
                        <!-- Mission -->
                        <div class="rounded-lg border border-green-600 bg-green-50 p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Mission</h3>
                            <p class="text-sm text-gray-700 leading-relaxed">
                                FEU Fortis Medical Center is dedicated to providing compassionate, high-quality
                                healthcare
                                through innovation, excellence, and integrity. We strive to advance medical practice,
                                research, and education to enhance community well-being.
                            </p>
                        </div>

                        <!-- Vision -->
                        <div class="rounded-lg border border-yellow-600 bg-yellow-50 p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Vision</h3>
                            <p class="text-sm text-gray-700 leading-relaxed">
                                To be a leading medical institution known for excellence in patient care, education, and
                                research,
                                upholding fortitude, excellence, and uprightness in all we do.
                            </p>
                        </div>
                    </div>

                    <!-- Right Column: About Us -->
                    <div class="rounded-lg border border-blue-600 bg-blue-50 p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">About Us</h3>
                        <p class="text-sm text-gray-700 leading-relaxed mb-3">
                            Our Pediatric Ward at FEU Fortis Medical Center offers specialized care for children in a
                            safe,
                            comforting, and nurturing environment. With child-focused facilities and a team of pediatric
                            specialists,
                            we aim to create a healing space for young patients.
                        </p>
                        <p class="text-sm text-gray-700 leading-relaxed mb-3">
                            We are committed to family-centered care, making sure that parents are fully supported and
                            involved
                            every step of the way. Our mission extends beyond medical treatment—it’s about building
                            trust,
                            relieving anxiety, and promoting joy through every stage of recovery.
                        </p>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            With modern equipment and a heart for children, we provide care that’s not only effective
                            but also
                            deeply empathetic.
                        </p>
                    </div>
                </section>




                <!-- Monthly Patients Chart and Recent Activity - Side by Side -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Monthly Patients Chart -->
                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Monthly Patient Analysis</h3>
                                <p class="text-sm text-gray-500">Patient count distribution by month</p>
                            </div>
                            <div class="flex space-x-2">
                                <div class="flex items-center">
                                    <div class="mr-1 h-3 w-3 rounded-sm bg-blue-500"></div>
                                    <span class="text-xs text-gray-500">2023</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div class="mt-6">
                            <div class="flex h-64 items-end space-x-1">
                                <!-- January -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 65%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,245</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Jan</div>
                                </div>

                                <!-- February -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 72%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,380</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Feb</div>
                                </div>

                                <!-- March -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 80%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,520</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Mar</div>
                                </div>

                                <!-- April -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 87%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,650</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Apr</div>
                                </div>

                                <!-- May -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 99%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,890</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">May</div>
                                </div>

                                <!-- June -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 92%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,760</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Jun</div>
                                </div>

                                <!-- July -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 96%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,820</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Jul</div>
                                </div>

                                <!-- August -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 100%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,905</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Aug</div>
                                </div>

                                <!-- September -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 92%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,750</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Sep</div>
                                </div>

                                <!-- October -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 88%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,680</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Oct</div>
                                </div>

                                <!-- November -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 82%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,560</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Nov</div>
                                </div>

                                <!-- December -->
                                <div class="flex flex-1 flex-col items-center">
                                    <div class="relative w-full">
                                        <div class="w-full rounded-t bg-blue-500 transition-all duration-500 hover:bg-blue-600"
                                            style="height: 78%"></div>
                                        <div
                                            class="absolute -top-7 left-1/2 -translate-x-1/2 whitespace-nowrap text-xs font-medium text-gray-700">
                                            1,490</div>
                                    </div>
                                    <div class="mt-2 text-xs font-medium text-gray-500">Dec</div>
                                </div>
                            </div>

                            <!-- X-axis -->
                            <div class="mt-4 border-t border-gray-200 pt-2">
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-500">Jan</span>
                                    <span class="text-xs text-gray-500">Dec</span>
                                </div>
                            </div>
                        </div>

                        <!-- Insights -->
                        <div class="mt-6 grid grid-cols-3 gap-2 rounded-lg border border-gray-100 bg-gray-50 p-3">
                            <div>
                                <p class="text-sm font-medium text-gray-700">Highest</p>
                                <p class="text-lg font-bold text-gray-900">August</p>
                                <p class="text-xs text-gray-500">1,905 patients</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Average</p>
                                <p class="text-lg font-bold text-gray-900">1,637</p>
                                <p class="text-xs text-gray-500">per month</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Total</p>
                                <p class="text-lg font-bold text-gray-900">19,650</p>
                                <p class="text-xs text-gray-500">in 2023</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
                            <p class="text-sm text-gray-500">Overview of the latest hospital activities</p>
                        </div>
                        <div class="px-4 pb-4">
                            <div class="space-y-4">
                                <div class="flex items-start gap-4">
                                    <div class="rounded-full bg-blue-100 p-2">
                                        <i class="icon-user-plus h-4 w-4 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">New patient admitted</p>
                                        <p class="text-xs text-gray-500">Room 302 - Dr. Martinez - 2 hours ago</p>
                                    </div>
                                </div>
                                <div class="h-px bg-gray-200"></div>
                                <div class="flex items-start gap-4">
                                    <div class="rounded-full bg-blue-100 p-2">
                                        <i class="icon-bed h-4 w-4 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Emergency surgery completed</p>
                                        <p class="text-xs text-gray-500">Operating Room 3 - Dr. Johnson - 4 hours ago
                                        </p>
                                    </div>
                                </div>
                                <div class="h-px bg-gray-200"></div>
                                <div class="flex items-start gap-4">
                                    <div class="rounded-full bg-blue-100 p-2">
                                        <i class="icon-user-plus h-4 w-4 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Patient discharged</p>
                                        <p class="text-xs text-gray-500">Room 145 - Dr. Williams - 5 hours ago</p>
                                    </div>
                                </div>
                                <div class="h-px bg-gray-200"></div>
                                <div class="flex items-start gap-4">
                                    <div class="rounded-full bg-blue-100 p-2">
                                        <i class="icon-bed h-4 w-4 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Room maintenance completed</p>
                                        <p class="text-xs text-gray-500">Wing B - Maintenance Staff - 6 hours ago</p>
                                    </div>
                                </div>
                                <div class="h-px bg-gray-200"></div>
                                <div class="flex items-start gap-4">
                                    <div class="rounded-full bg-blue-100 p-2">
                                        <i class="icon-user-plus h-4 w-4 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">New appointment scheduled</p>
                                        <p class="text-xs text-gray-500">Dr. Chen - Tomorrow at 10:30 AM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pediatric Footer -->
                <footer
                    class="relative mt-16 bg-gradient-to-r bg-gradient-to-br from-green-100 to-blue-100 px-6 py-12 text-gray-700">
                    <!-- Wavy top SVG -->
                    <div class="absolute top-0 left-0 w-full -translate-y-full">
                        <svg viewBox="0 0 1440 320" class="w-full h-16" preserveAspectRatio="none">
                            <path fill="#ffffff" fill-opacity="1"
                                d="M0,64L60,74.7C120,85,240,107,360,117.3C480,128,600,128,720,117.3C840,107,960,85,1080,90.7C1200,96,1320,128,1380,144L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
                            </path>
                        </svg>
                    </div>

                    <div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- Contact Info -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Contact Us</h4>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center gap-2">
                                    <i class="icon-phone h-4 w-4 text-blue-600"></i>
                                    <span>(02) 812-3456</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="icon-mail h-4 w-4 text-blue-600"></i>
                                    <span>pediacare@feufortis.ph</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="icon-map-pin h-4 w-4 text-blue-600"></i>
                                    <span>FEU Fortis, Las Piñas, Metro Manila</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Quick Links</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="/about" class="hover:text-blue-700">About Us</a></li>
                                <li><a href="/services" class="hover:text-blue-700">Our Services</a></li>
                                <li><a href="/wards/pedia" class="hover:text-blue-700">Pedia Ward</a></li>
                                <li><a href="/contact" class="hover:text-blue-700">Contact</a></li>
                                <li><a href="/faqs" class="hover:text-blue-700">FAQs</a></li>
                            </ul>
                        </div>

                        <!-- Social Media -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Follow Us</h4>
                            <ul class="flex space-x-4 text-xl">
                                <li>
                                    <a href="https://facebook.com/feufortis" target="_blank"
                                        class="hover:text-blue-700">
                                        <i class="icon-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://instagram.com/feufortis" target="_blank"
                                        class="hover:text-pink-500">
                                        <i class="icon-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/feufortis" target="_blank" class="hover:text-sky-500">
                                        <i class="icon-twitter"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="mt-10 text-center text-xs text-gray-500">
                        &copy; 2025 FEU Fortis Medical Center – Pedia Ward. All rights reserved.
                    </div>
                </footer>



            </div>
        </main>

    </AuthenticatedLayout>
</template>
