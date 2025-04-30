<template>
    <div class="w-full max-w-sm space-y-4">
        <!-- CDSS Dropdown -->
        <div>
            <label for="cdss" class="block text-sm font-medium text-gray-700 mb-1">Select Category</label>
            <select name="cdss" id="cdss"
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
            <select name="nursingDiagnosis" id="nursingDiagnosis"
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
    </div>
</template>