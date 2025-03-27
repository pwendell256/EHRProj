<script setup lang="ts">
import NavMain from '@/Components/sidebar08/NavMain.vue'
import NavProjects from '@/Components/sidebar08/NavProjects.vue'
import NavSecondary from '@/Components/sidebar08/NavSecondary.vue'
import NavUser from '@/Components/sidebar08/NavUser.vue'
import { Link } from '@inertiajs/vue3';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    type SidebarProps,
} from '@/Components/ui/sidebar'
import {
    BookOpen,
    Bot,
    Command,
    Frame,
    LifeBuoy,
    Map,
    PieChart,
    Send,
    Settings2,
    SquareTerminal,
} from 'lucide-vue-next'
const props = withDefaults(defineProps<SidebarProps>(), {
    variant: 'inset',
})
const data = {
    user: {
        name: 'shadcn',
        email: 'm@example.com',
        avatar: '/avatars/shadcn.jpg',
    },
    navMain: [
        {
            title: 'Dashboard',
            url: route('dashboard'),
            icon: SquareTerminal,
            isActive: true,
        },
        {
            title: 'Patient Management',
            url: route('patient.index'),
            icon: Bot,

        },
        {
            title: 'Account Management',
            url: route('patient.index'),
            icon: BookOpen,

        },
        {
            title: 'Settings',
            url: route('config.index'),
            icon: Settings2,

        },
    ],


}
</script>
<template>
    <Sidebar v-bind="props">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton class="cursor-default" size="lg" as-child>
                        <a href="#">
                            <img src="../../Images/LOGO.png" alt="Logo" class=" object-contain" />

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                
                            </div>
                        </a>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>
        <SidebarContent>
            <NavMain :items="data.navMain" />
        </SidebarContent>
        <SidebarFooter>
            <NavUser :user="data.user" />
        </SidebarFooter>
    </Sidebar>
</template>