<script setup lang="ts">
import { usePage, Link } from '@inertiajs/vue3'
import NavMain from '@/Components/sidebar08/NavMain.vue'
import NavProjects from '@/Components/sidebar08/NavProjects.vue'
import NavSecondary from '@/Components/sidebar08/NavSecondary.vue'
import NavUser from '@/Components/sidebar08/NavUser.vue'

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
    LayoutDashboard,
} from 'lucide-vue-next'

// ⬇️ This is the fix
const page = usePage()

const props = withDefaults(defineProps<SidebarProps>(), {
    variant: 'inset',
})

const data = {
    user: {
        name: page.props.auth?.user?.name,
        email: page.props.auth?.user?.email,
        avatar: '/avatars/shadcn.jpg',
    },
    navMain: [
        {
            title: 'Dashboard',
            url: route('dashboard'),
            icon: LayoutDashboard,
        },
        {
            title: 'Electronic Health Record',
            url: route('dashboard'),
            icon: SquareTerminal,
            isActive: true,
            items: [
                {
                    title: 'Pedia Ward',
                    url: route('patient.index'),
                },
            ],
        },
        {
            title: 'Accounts Management',
            url: route('account.index'),
            icon: BookOpen,
        },
    ],
}
</script>

<template>
    <Sidebar v-bind="props">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton class="cursor-default h-99"  as-child>
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