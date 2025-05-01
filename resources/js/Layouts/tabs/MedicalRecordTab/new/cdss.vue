<template>
    <div class="w-full max-w-sm space-y-4">
        <!-- CDSS Dropdown -->
        <div>
            <label for="cdss" class="block text-sm font-medium text-gray-700 mb-1">Gordon's Functional Health
                Patterns</label>
            <select id="cdss" v-model="selectedCategory"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                <option>Activity/Rest</option>
                <option>Circulation</option>
                <option>Comfort</option>
                <option>Elimination</option>
                <option>Food/Fluid</option>
                <option>Health Management</option>
                <option>Neurosensory</option>
                <option>Respiration</option>
                <option>Roles/ Relationships</option>
                <option>Safety</option>
                <option>Self-Care</option>
                <option>Self-Perception/Concept</option>
                <option>Sexuality/Reproduction</option>
                <option>Stress Management</option>
                <option>Values/Beliefs</option>
            </select>
        </div>

        <!-- Nursing Diagnosis Dropdown -->
        <div>
            <label for="nursingDiagnosis" class="block text-sm font-medium text-gray-700 mb-1">Nursing Diagnosis</label>
            <select id="nursingDiagnosis" v-model="selectedDiagnosis"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                <option>Chronic Pain Syndrome</option>
                <option>Comfort, Impaired</option>
                <option>Dry Mouth, Risk for</option>
                <option>Dry Eye, Risk for</option>
                <option>Dry Eye Self-Management</option>
                <option>Pain, Acute</option>
                <option>Pain Chronic</option>
                <option>Pain Labor</option>
            </select>
        </div>

        <!-- Related To Textbox -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Related to:</label>
            <textarea v-model="relatedTo"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                rows="2"></textarea>
        </div>

        <!-- As Evidenced By Textbox -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">As evidenced by:</label>
            <textarea v-model="asEvidencedBy"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                rows="3"></textarea>
        </div>

        <!-- Conditional Content -->
        <!-- Conditional Content -->
        <div v-if="showInterventionsAndDecisionMaking" class="flex justify-center">
            <div class="w-full max-w-3xl space-y-6">
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