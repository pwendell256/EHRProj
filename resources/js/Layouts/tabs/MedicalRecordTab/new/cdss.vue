<template>
    <div class="w-full space-y-4 ">
        <!-- CDSS Dropdown -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
            <!-- Gordon's Functional Health Patterns Dropdown -->
            <div>
                <Label for="cdss" class="block text-sm font-medium text-gray-700 mb-1">
                    Gordon's Functional Health Patterns
                </Label>
                <Select v-model="selectedCategory">
                    <SelectTrigger id="cdss"
                        class="w-full mt-1 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <SelectValue placeholder="Select a pattern" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Patterns</SelectLabel>
                            <SelectItem value="Activity/Rest">Activity/Rest</SelectItem>
                            <SelectItem value="Circulation">Circulation</SelectItem>
                            <SelectItem value="Comfort">Comfort</SelectItem>
                            <SelectItem value="Elimination">Elimination</SelectItem>
                            <SelectItem value="Food/Fluid">Food/Fluid</SelectItem>
                            <SelectItem value="Health Management">Health Management</SelectItem>
                            <SelectItem value="Neurosensory">Neurosensory</SelectItem>
                            <SelectItem value="Respiration">Respiration</SelectItem>
                            <SelectItem value="Roles/ Relationships">Roles/ Relationships</SelectItem>
                            <SelectItem value="Safety">Safety</SelectItem>
                            <SelectItem value="Self-Care">Self-Care</SelectItem>
                            <SelectItem value="Self-Perception/Concept">Self-Perception/Concept</SelectItem>
                            <SelectItem value="Sexuality/Reproduction">Sexuality/Reproduction</SelectItem>
                            <SelectItem value="Stress Management">Stress Management</SelectItem>
                            <SelectItem value="Values/Beliefs">Values/Beliefs</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>

            <!-- Nursing Diagnosis Dropdown -->
            <div>
                <Label for="nursingDiagnosis" class="block text-sm font-medium text-gray-700 mb-1">
                    Nursing Diagnosis
                </Label>
                <Select v-model="selectedDiagnosis">
                    <SelectTrigger id="nursingDiagnosis"
                        class="w-full mt-1 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <SelectValue placeholder="Select a diagnosis" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Diagnoses</SelectLabel>
                            <SelectItem value="Chronic Pain Syndrome">Chronic Pain Syndrome</SelectItem>
                            <SelectItem value="Comfort, Impaired">Comfort, Impaired</SelectItem>
                            <SelectItem value="Dry Mouth, Risk for">Dry Mouth, Risk for</SelectItem>
                            <SelectItem value="Dry Eye, Risk for">Dry Eye, Risk for</SelectItem>
                            <SelectItem value="Dry Eye Self-Management">Dry Eye Self-Management</SelectItem>
                            <SelectItem value="Pain, Acute">Pain, Acute</SelectItem>
                            <SelectItem value="Pain Chronic">Pain Chronic</SelectItem>
                            <SelectItem value="Pain Labor">Pain Labor</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>

            <!-- Related To Textbox -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Related to:</label>
                <Textarea v-model="relatedTo"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    rows="2"></Textarea>
            </div>

            <!-- As Evidenced By Textbox -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">As evidenced by:</label>
                <Textarea v-model="asEvidencedBy"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    rows="2"></Textarea>
            </div>
        </div>


        <!-- Conditional Content -->
        <!-- Conditional Content -->
        <div v-if="showInterventionsAndDecisionMaking" class="flex justify-center">
            <div class="w-full max-w-6xl space-y-6">
                <h3 class="text-lg font-semibold mt-6 mb-2">Nursing Interventions</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border border-gray-300">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Intervention</th>
                                <th class="border border-gray-300 px-4 py-2">Rationale</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            <tr v-for="(item, index) in interventions" :key="index">
                                <td class="border border-gray-300 px-4 py-2" v-html="item.intervention"></td>
                                <td class="border border-gray-300 px-4 py-2" v-html="item.rationale"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="text-lg font-semibold mt-6">Decision Making</h3>
                <ol class="list-decimal ml-5 space-y-2 text-sm">
                    <li><strong>Assessment-Based Prioritization:</strong> Pain was the most immediate symptom...</li>
                    <li><strong>Individualized Care Planning:</strong> Age-appropriate scale and combined methods used.
                    </li>
                    <li><strong>Medication Safety Consideration:</strong> Allergy to Amoxicillin considered.</li>
                    <li><strong>Family Involvement:</strong> Parents educated for continuity of care.</li>
                    <li><strong>Reassessment and Adaptation:</strong> Interventions evaluated and adjusted.</li>
                    <li><strong>Discharge Planning:</strong> Included education for monitoring and follow-up.</li>
                </ol>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
import Textarea from '@/Components/ui/textarea/Textarea.vue';
import Button from '@/components/ui/button/Button.vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuShortcut,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/Components/ui/alert-dialog'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/Components/ui/dialog'
import {
    Drawer,
    DrawerClose,
    DrawerContent,
    DrawerDescription,
    DrawerFooter,
    DrawerHeader,
    DrawerTitle,
    DrawerTrigger,
} from '@/Components/ui/drawer'

const selectedCategory = ref('')
const selectedDiagnosis = ref('')
const relatedTo = ref('')
const asEvidencedBy = ref('')

// Normalize helper: replaces curly apostrophes and trims whitespace
const normalize = (str) => str.replace(/[’‘]/g, "'").trim().toLowerCase()

const showInterventionsAndDecisionMaking = computed(() => {
    return (
        selectedCategory.value === 'Comfort' &&
        selectedDiagnosis.value === 'Pain, Acute' &&
        normalize(relatedTo.value) === "inflammation of the middle ear" &&
        normalize(asEvidencedBy.value) ===
        "patient's verbal report of 7/10 pain, throbbing sensation, and non-verbal cues such as grimacing and holding the left ear"
    )
})


const interventions = [
    {
        intervention: "1. Assess pain intensity, location, duration, and characteristics using an age-appropriate pain scale (e.g., Wong-Baker FACES).",
        rationale: "Helps determine baseline and effectiveness of pain management strategies.",
    },
    {
        intervention: "2. Monitor and document the child's verbal and non-verbal pain cues (e.g., facial expression, guarding behavior).",
        rationale: "Provides objective data for evaluating pain and tailoring interventions.",
    },
    {
        intervention: "3. Administer prescribed analgesics (e.g., Acetaminophen) as indicated.",
        rationale: "Reduces inflammation and alleviates pain through pharmacological means.",
    },
    {
        intervention: "4. Apply warm compress to the affected ear if ordered and tolerated.",
        rationale: "Warmth may help reduce localized pain and promote circulation.",
    },
    {
        intervention: "5. Encourage the child to rest in a comfortable position, preferably with the head elevated.",
        rationale: "Elevating the head can decrease ear pressure and relieve discomfort.",
    },
    {
        intervention: "6. <strong>Provide quiet</strong>, low-stimulation environment and encourage the use of distraction techniques (e.g., storytelling, soft music).",
        rationale: "Helps divert the child's attention away from the pain and promotes relaxation.",
    },
    {
        intervention: "7. Instruct parents to observe and report signs of worsening pain, fever, or ear discharge.",
        rationale: "Ensures early detection of complications or treatment failure.",
    },
]

</script>