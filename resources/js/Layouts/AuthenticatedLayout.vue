<script lang="ts">
export const description = 'An inset sidebar with secondary navigation.'
export const iframeHeight = '800px'
</script>
<script setup lang="ts">
import AppSidebar from '@/Components/sidebar08/AppSidebar.vue'
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/Components/ui/breadcrumb'
import { Separator } from '@/Components/ui/separator'
import {
    SidebarInset,
    SidebarProvider,
    SidebarTrigger,
} from '@/Components/ui/sidebar'
import { ArrowLeft } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'
import { Button } from '@/Components/ui/button'
</script>
<template>
    <SidebarProvider>
        <AppSidebar />
        <SidebarInset>
            <header class="flex h-16 shrink-0 items-center gap-2">
                <div class="flex items-center gap-2 px-4">
                    <SidebarTrigger class="-ml-1" />
                    <Separator orientation="vertical" class="mr-2 h-4" />
                    <Breadcrumb>
                        <BreadcrumbList>
                            <BreadcrumbItem class="hidden md:block">
                                <BreadcrumbLink href="#">
                                    Building Your Application
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator class="hidden md:block" />
                            <BreadcrumbItem>
                                <BreadcrumbPage>Data Fetching</BreadcrumbPage>
                            </BreadcrumbItem>
                        </BreadcrumbList>
                    </Breadcrumb>
                </div>
            </header>
   
            <div class="flex flex-1 flex-col gap-4 p-4 pt-0">
                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </SidebarInset>
    </SidebarProvider>
</template>