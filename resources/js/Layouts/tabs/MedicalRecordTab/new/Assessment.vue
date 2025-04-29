<template>
    <div class="assessment-form">
        <form @submit.prevent="submitForm">
            <h1 class="text-2xl font-bold mb-6">Triggers</h1>
            <div class="form-group">
                <Label for="skin-description" class="block mb-1">Triggers:</Label>
                <Textarea id="skin-description" v-model="form.triggers" rows="3"
                    class="w-full p-2 border rounded"></textarea>
            </div>

            <h1 class="text-2xl font-bold mb-6">Medical Assessment Form</h1>


            <!-- Assessor Information -->
            <div class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-group">
                        <Label for="conductor" class="block mb-1">Assessment Conducted by:</Label>
                        <Input type="text" id="conductor" v-model="form.conductor" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="date" class="block mb-1">Date:</Label>
                        <Input type="date" id="date" v-model="form.date" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="time" class="block mb-1">Time:</Label>
                        <Input type="time" id="time" v-model="form.time" class="w-full p-2 border rounded" />
                    </div>
                </div>
            </div>

            <!-- Physical Assessment - Orientation -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Physical Assessment</h2>
                <h3 class="text-lg font-medium mb-2">Level of Orientation</h3>
                <div class="flex flex-wrap gap-4">
                    <div v-for="option in orientationLevels" :key="option" class="flex items-center">
                        <input type="radio" :id="'orientation-' + option.toLowerCase()" :value="option"
                            v-model="form.orientation_level" class="mr-2" />
                        <Label :for="'orientation-' + option.toLowerCase()">{{ option }}</Label>
                    </div>
                </div>
            </div>

            <!-- Orientation Details -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Orientation</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <Label for="person" class="block mb-1">Person:</Label>
                        <Input type="text" id="person" v-model="form.person" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="place" class="block mb-1">Place:</Label>
                        <Input type="text" id="place" v-model="form.place" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="orient-time" class="block mb-1">Time:</Label>
                        <Input type="text" id="orient-time" v-model="form.time" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="situation" class="block mb-1">Situation:</Label>
                        <Input type="text" id="situation" v-model="form.situation" class="w-full p-2 border rounded" />
                    </div>
                </div>
            </div>

            <!-- Vitals -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Vitals</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="form-group">
                        <Label for="temperature" class="block mb-1">Temperature:</Label>
                        <Input type="text" id="temperature" v-model="form.temperature"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="blood-pressure" class="block mb-1">Blood Pressure:</Label>
                        <Input type="text" id="blood-pressure" v-model="form.blood_pressure"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="respiratory-rate" class="block mb-1">Respiratory Rate:</Label>
                        <Input type="text" id="respiratory-rate" v-model="form.respiratory_rate"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="pulse-rate" class="block mb-1">Pulse Rate:</Label>
                        <Input type="text" id="pulse-rate" v-model="form.pulse_rate"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="oxygen-sat" class="block mb-1">Oxygen Saturation:</Label>
                        <Input type="text" id="oxygen-sat" v-model="form.oxygen_saturation"
                            class="w-full p-2 border rounded" />
                    </div>
                </div>
            </div>

            <!-- Head Assessment -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Head</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <Label for="hair" class="block mb-1">Hair:</Label>
                        <Input type="text" id="hair" v-model="form.hair" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="eyes" class="block mb-1">Eyes:</Label>
                        <Input type="text" id="eyes" v-model="form.eyes" class="w-full p-2 border rounded" />
                        <div class="mt-2">
                            <input type="checkbox" id="perrla" v-model="form.perrla" class="mr-2" />
                            <Label for="perrla">PERRLA</Label>
                        </div>
                    </div>
                    <div class="form-group">
                        <Label for="nose" class="block mb-1">Nose:</Label>
                        <Input type="text" id="nose" v-model="form.nose" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="ears" class="block mb-1">Ears:</Label>
                        <Input type="text" id="ears" v-model="form.ears" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group col-span-1 md:col-span-2">
                        <Label for="mouth" class="block mb-1">Mouth:</Label>
                        <Input type="text" id="mouth" v-model="form.mouth" class="w-full p-2 border rounded" />
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2">
                            <div>
                                <input type="checkbox" id="midline-tongue" v-model="form.midline_tongue" class="mr-1" />
                                <Label for="midline-tongue">Midline tongue</Label>
                            </div>
                            <div>
                                <input type="checkbox" id="moist" v-model="form.moist" class="mr-1" />
                                <Label for="moist">Moist</Label>
                            </div>
                            <div>
                                <input type="checkbox" id="lesions" v-model="form.lesions" class="mr-1" />
                                <Label for="lesions">Lesions</Label>
                            </div>
                            <div>
                                <input type="checkbox" id="dentition" v-model="form.dentition" class="mr-1" />
                                <Label for="dentition">Dentition</Label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Neck Assessment -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Neck</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-group">
                        <input type="checkbox" id="carotid-pulse" v-model="form.carotid_pulse" class="mr-2" />
                        <Label for="carotid-pulse">Carotid Pulse</Label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="jugular-vein" v-model="form.jugular_vein_distention" class="mr-2" />
                        <Label for="jugular-vein">Jugular Vein Distention</Label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="trachea-midline" v-model="form.trachea_midline" class="mr-2" />
                        <Label for="trachea-midline">Trachea Midline</Label>
                    </div>
                </div>
            </div>

            <!-- Chest Section -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Chest</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <Label class="block mb-1">Apical Pulse:</Label>
                        <div class="ml-4">
                            <div>
                                <input type="checkbox" id="muffled" v-model="form.muffled" class="mr-2" />
                                <Label for="muffled">Muffled</Label>
                            </div>
                            <div>
                                <input type="checkbox" id="arrhythmia" v-model="form.arrhythmia" class="mr-2" />
                                <Label for="arrhythmia">Arrhythmia</Label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <Label class="block mb-1">Breath Sounds:</Label>
                        <div class="grid grid-cols-3 gap-2 ml-4">
                            <div>
                                <input type="checkbox" id="anterior" v-model="form.anterior" class="mr-1" />
                                <Label for="anterior">Anterior</Label>
                            </div>
                            <div>
                                <input type="checkbox" id="posterior" v-model="form.posterior" class="mr-1" />
                                <Label for="posterior">Posterior</Label>
                            </div>
                            <div>
                                <input type="checkbox" id="lateral" v-model="form.lateral" class="mr-1" />
                                <Label for="lateral">Lateral</Label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="chest-symmetry" v-model="form.chest_symmetry" class="mr-2" />
                        <Label for="chest-symmetry">Chest Symmetry</Label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="skin-turgor" v-model="form.skin_turgor" class="mr-2" />
                        <Label for="skin-turgor">Skin Turgor (Clavicle)</Label>
                    </div>
                </div>
            </div>

            <!-- Abdomen Section -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Abdomen</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <Label for="inspection" class="block mb-1">Inspection:</Label>
                        <Input type="text" id="inspection" v-model="form.inspection"
                            class="w-full p-2 border rounded" />
                    </div>

                    <div class="form-group">
                        <Label for="palpation" class="block mb-1">Palpation:</Label>
                        <Input type="text" id="palpation" v-model="form.palpation" class="w-full p-2 border rounded" />
                    </div>

                    <div class="form-group col-span-1 md:col-span-2">
                        <Label class="block mb-1">Auscultation:</Label>
                        <Input type="text" id="auscultation" v-model="form.auscultation"
                            class="w-full p-2 border rounded mb-2" />

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                            <div class="quadrant-group">
                                <Label class="block mb-1">LUQ:</Label>
                                <div>
                                    <input type="radio" id="luq-active" value="Active" v-model="form.luq"
                                        class="mr-1" />
                                    <Label for="luq-active">Active</Label>
                                </div>
                                <div>
                                    <input type="radio" id="luq-hyper" value="Hyper" v-model="form.luq" class="mr-1" />
                                    <Label for="luq-hyper">Hyper</Label>
                                </div>
                                <div>
                                    <input type="radio" id="luq-absent" value="Absent" v-model="form.luq"
                                        class="mr-1" />
                                    <Label for="luq-absent">Absent</Label>
                                </div>
                            </div>

                            <div class="quadrant-group">
                                <Label class="block mb-1">RUQ:</Label>
                                <div>
                                    <input type="radio" id="ruq-active" value="Active" v-model="form.ruq"
                                        class="mr-1" />
                                    <Label for="ruq-active">Active</Label>
                                </div>
                                <div>
                                    <input type="radio" id="ruq-hyper" value="Hyper" v-model="form.ruq" class="mr-1" />
                                    <Label for="ruq-hyper">Hyper</Label>
                                </div>
                                <div>
                                    <input type="radio" id="ruq-absent" value="Absent" v-model="form.ruq"
                                        class="mr-1" />
                                    <Label for="ruq-absent">Absent</Label>
                                </div>
                            </div>

                            <div class="quadrant-group">
                                <Label class="block mb-1">LLQ:</Label>
                                <div>
                                    <input type="radio" id="llq-active" value="Active" v-model="form.llq"
                                        class="mr-1" />
                                    <Label for="llq-active">Active</Label>
                                </div>
                                <div>
                                    <input type="radio" id="llq-hyper" value="Hyper" v-model="form.llq" class="mr-1" />
                                    <Label for="llq-hyper">Hyper</Label>
                                </div>
                                <div>
                                    <input type="radio" id="llq-absent" value="Absent" v-model="form.llq"
                                        class="mr-1" />
                                    <Label for="llq-absent">Absent</Label>
                                </div>
                            </div>

                            <div class="quadrant-group">
                                <Label class="block mb-1">RLQ:</Label>
                                <div>
                                    <input type="radio" id="rlq-active" value="Active" v-model="form.rlq"
                                        class="mr-1" />
                                    <Label for="rlq-active">Active</Label>
                                </div>
                                <div>
                                    <input type="radio" id="rlq-hyper" value="Hyper" v-model="form.rlq" class="mr-1" />
                                    <Label for="rlq-hyper">Hyper</Label>
                                </div>
                                <div>
                                    <input type="radio" id="rlq-absent" value="Absent" v-model="form.rlq"
                                        class="mr-1" />
                                    <Label for="rlq-absent">Absent</Label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upper Extremities -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Upper Extremities</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <Label for="radial-pulses" class="block mb-1">Radial Pulses equal, +2:</Label>
                        <Input type="text" id="radial-pulses" v-model="form.radial_pulses"
                            class="w-full p-2 border rounded" />
                        <Input type="text" id="radial-other" v-model="form.radial_other"
                            class="w-full p-2 border rounded mt-2" placeholder="Other" />
                    </div>

                    <div class="form-group">
                        <Label class="block mb-1">Temperature (Trunk):</Label>
                        <div>
                            <input type="radio" id="temp-warm" value="Warm" v-model="form.temperaturetrunk"
                                class="mr-1" />
                            <Label for="temp-warm">Warm</Label>
                        </div>
                        <div>
                            <input type="radio" id="temp-cool" value="Cool" v-model="form.temperaturetrunk"
                                class="mr-1" />
                            <Label for="temp-cool">Cool</Label>
                        </div>
                    </div>

                    <div class="form-group">
                        <Label for="grip" class="block mb-1">Grip equal and strong:</Label>
                        <Input type="text" id="grip" v-model="form.grip" class="w-full p-2 border rounded" />
                    </div>

                    <div class="form-group">
                        <Label for="capillary-refill" class="block mb-1">Capillary refill < 3secs.:</Label>
                                <Input type="text" id="capillary-refill" v-model="form.capillary_refill"
                                    class="w-full p-2 border rounded" />
                    </div>
                </div>
            </div>

            <!-- Lower Extremities -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Lower Extremities</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <input type="checkbox" id="hair-present" v-model="form.hair_present" class="mr-2" />
                        <Label for="hair-present">Hair present</Label>
                    </div>

                    <div class="form-group">
                        <Label for="edema" class="block mb-1">Edema:</Label>
                        <Input type="text" id="edema" v-model="form.edema" class="w-full p-2 border rounded" />
                    </div>

                    <div class="form-group">
                        <Label for="foot-strength" class="block mb-1">Foot strength:</Label>
                        <Input type="text" id="foot-strength" v-model="form.foot_strength"
                            class="w-full p-2 border rounded" />
                    </div>

                    <div class="form-group">
                        <Label class="block mb-1">Nails:</Label>
                        <div class="flex flex-wrap gap-4">
                            <div>
                                <input type="checkbox" id="yellowed" v-model="form.yellowed" class="mr-1" />
                                <Label for="yellowed">Yellowed</Label>
                            </div>
                            <div>
                                <input type="checkbox" id="thickened" v-model="form.thickened" class="mr-1" />
                                <Label for="thickened">Thickened</Label>
                            </div>
                            <div>
                                <input type="checkbox" id="ingrown" v-model="form.ingrown" class="mr-1" />
                                <Label for="ingrown">Ingrown</Label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROM and Strength -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">ROM / Strength</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <Label for="upper-r1" class="block mb-1">Upper R:</Label>
                        <Input type="text" id="upper-r1" v-model="form.upper_r1" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="upper-r2" class="block mb-1">Upper R:</Label>
                        <Input type="text" id="upper-r2" v-model="form.upper_r2" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="upper-l1" class="block mb-1">Upper L:</Label>
                        <Input type="text" id="upper-l1" v-model="form.upper_l1" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="upper-l2" class="block mb-1">Upper L:</Label>
                        <Input type="text" id="upper-l2" v-model="form.upper_l2" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="lower-r1" class="block mb-1">Lower R:</Label>
                        <Input type="text" id="lower-r1" v-model="form.lower_r1" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="lower-r2" class="block mb-1">Lower R:</Label>
                        <Input type="text" id="lower-r2" v-model="form.lower_r2" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="lower-l1" class="block mb-1">Lower L:</Label>
                        <Input type="text" id="lower-l1" v-model="form.lower_l1" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="lower-l2" class="block mb-1">Lower L:</Label>
                        <Input type="text" id="lower-l2" v-model="form.lower_l1" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group col-span-1 md:col-span-2">
                        <Label for="sensation" class="block mb-1">Sensation:</Label>
                        <Input type="text" id="sensation" v-model="form.sensation" class="w-full p-2 border rounded" />
                    </div>
                </div>
            </div>

            <!-- General Assessment -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">General Assessment</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-group">
                        <Label for="weight" class="block mb-1">Weight:</Label>
                        <Input type="text" id="weight" v-model="form.weight" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="height" class="block mb-1">Height:</Label>
                        <Input type="text" id="height" v-model="form.height" class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="bmi" class="block mb-1">BMI:</Label>
                        <Input type="text" id="bmi" v-model="form.bmi" class="w-full p-2 border rounded" />
                    </div>
                </div>
            </div>

            <!-- Pain Assessment -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Pain Assessment</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <Label class="block mb-1">Acute/Chronic:</Label>
                        <Select v-model="form.type">
                            <SelectTrigger class="w-full">
                                <SelectValue placeholder="Select condition type" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Condition Type</SelectLabel>
                                    <SelectItem value="Acute">Acute</SelectItem>
                                    <SelectItem value="Chronic">Chronic</SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="form-group">
                        <Label for="pain-intensity" class="block mb-1">Intensity (0-10):</Label>
                        <Input type="number" id="pain-intensity" v-model="form.intensity" min="0" max="10"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="pain-location" class="block mb-1">Location:</Label>
                        <Input type="text" id="pain-location" v-model="form.location"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="pain-duration" class="block mb-1">Duration:</Label>
                        <Input type="text" id="pain-duration" v-model="form.duration"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="pain-characteristics" class="block mb-1">Characteristics:</Label>
                        <Input type="text" id="pain-characteristics" v-model="form.characteristics"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="pain-precipitation" class="block mb-1">Precipitation:</Label>
                        <Input type="text" id="pain-precipitation" v-model="form.precipitation"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="pain-frequency" class="block mb-1">Frequency:</Label>
                        <Input type="text" id="pain-frequency" v-model="form.frequency"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="pain-nonverbals" class="block mb-1">Non-verbals:</Label>
                        <Input type="text" id="pain-nonverbals" v-model="form.nonverbals"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="pain-relief" class="block mb-1">Relief factors:</Label>
                        <Input type="text" id="pain-relief" v-model="form.reliefFactors"
                            class="w-full p-2 border rounded" />
                    </div>
                    <div class="form-group">
                        <Label for="pain-sleep" class="block mb-1">Sleep:</Label>
                        <Input type="text" id="pain-sleep" v-model="form.sleep" class="w-full p-2 border rounded" />
                    </div>
                </div>
            </div>

            <!-- Skin Assessment -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Skin Assessment</h3>
                <div class="form-group">
                    <Label for="skin-description" class="block mb-1">Description:</Label>
                    <Textarea id="skin-description" v-model="form.description" rows="3"
                        class="w-full p-2 border rounded"></textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-4">
                <Button type="submit">
                    Submit
                </Button>
            </div>
        </form>
    </div>
    
    <Medication :patient="patient" />

</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

import Medication from '../../Medication.vue';
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
} from '@/components/ui/select'
import Textarea from '@/Components/ui/textarea/Textarea.vue';
import Button from '@/components/ui/button/Button.vue';

const orientationLevels = ['Alert', 'Confused', 'Drowsy', 'Unresponsive'];

const props = defineProps({
    patient: Object
})

const form = useForm({
    triggers : props.patient?.assessment.triggers ?? '',
    conductor: props.patient?.assessment.conductor ?? '',
    date: props.patient?.assessment.date ?? '',
    time: props.patient?.assessment.time ?? '',
    orientation_level: props.patient?.assessment.orientation_level ?? '',
    person: props.patient?.assessment.person ?? '',
    place: props.patient?.assessment.place ?? '',
    situation: props.patient?.assessment.situation ?? '',
    temperature: props.patient?.assessment.temperature ?? '',
    blood_pressure: props.patient?.assessment.blood_pressure ?? '',
    respiratory_rate: props.patient?.assessment.respiratory_rate ?? '',
    pulse_rate: props.patient?.assessment.pulse_rate ?? '',
    oxygen_saturation: props.patient?.assessment.oxygen_saturation ?? '',
    hair: props.patient?.assessment.hair ?? '',
    eyes: props.patient?.assessment.eyes ?? '',
    perrla: props.patient?.assessment.perrla === 1,
    nose: props.patient?.assessment.nose ?? '',
    ears: props.patient?.assessment.ears ?? '',
    mouth: props.patient?.assessment.mouth ?? '',
    midline_tongue: props.patient?.assessment.midline_tongue === 1,
    moist: props.patient?.assessment.moist === 1,
    lesions: props.patient?.assessment.lesions === 1,
    dentition: props.patient?.assessment.dentition === 1,
    carotid_pulse: props.patient?.assessment.carotid_pulse === 1,
    jugular_vein_distention: props.patient?.assessment.jugular_vein_distention === 1,
    trachea_midline: props.patient?.assessment.trachea_midline === 1,
    muffled: props.patient?.assessment.muffled === 1,
    arrhythmia: props.patient?.assessment.arrhythmia === 1,
    anterior: props.patient?.assessment.anterior === 1,
    posterior: props.patient?.assessment.posterior === 1,
    lateral: props.patient?.assessment.lateral === 1,
    chest_symmetry: props.patient?.assessment.chest_symmetry === 1,
    skin_turgor: props.patient?.assessment.skin_turgor === 1,
    inspection: props.patient?.assessment.inspection ?? '',
    palpation: props.patient?.assessment.palpation ?? '',
    auscultation: props.patient?.assessment.auscultation ?? '',
    luq: props.patient?.assessment.luq ?? '',
    ruq: props.patient?.assessment.ruq ?? '',
    llq: props.patient?.assessment.llq ?? '',
    rlq: props.patient?.assessment.rlq ?? '',
    radial_pulses: props.patient?.assessment.radial_pulses ?? '',
    radial_other: props.patient?.assessment.radial_other ?? '',
    temperaturetrunk: props.patient?.assessment.temperaturetrunk ?? '',
    grip: props.patient?.assessment.grip ?? '',
    capillary_refill: props.patient?.assessment.capillary_refill ?? '',
    hair_present: props.patient?.assessment.hair_present === 1,
    edema: props.patient?.assessment.edema ?? '',
    foot_strength: props.patient?.assessment.foot_strength ?? '',
    yellowed: props.patient?.assessment.yellowed === 1,
    thickened: props.patient?.assessment.thickened === 1,
    ingrown: props.patient?.assessment.ingrown === 1,
    upper_r1: props.patient?.assessment.upper_r1 ?? '',
    upper_r2: props.patient?.assessment.upper_r2 ?? '',
    upper_l1: props.patient?.assessment.upper_l1 ?? '',
    upper_l2: props.patient?.assessment.upper_l2 ?? '',
    lower_r1: props.patient?.assessment.lower_r1 ?? '',
    lower_r2: props.patient?.assessment.lower_r2 ?? '',
    lower_l1: props.patient?.assessment.lower_l1 ?? '',
    lower_l2: props.patient?.assessment.lower_l2 ?? '',
    sensation: props.patient?.assessment.sensation ?? '',
    weight: props.patient?.assessment.weight ?? '',
    height: props.patient?.assessment.height ?? '',
    bmi: props.patient?.assessment.bmi ?? '',
    type: props.patient?.assessment.type ?? '',
    intensity: props.patient?.assessment.intensity ?? '',
    location: props.patient?.assessment.location ?? '',
    duration: props.patient?.assessment.duration ?? '',
    characteristics: props.patient?.assessment.characteristics ?? '',
    precipitation: props.patient?.assessment.precipitation ?? '',
    frequency: props.patient?.assessment.frequency ?? '',
    nonverbals: props.patient?.assessment.nonverbals ?? '',
    reliefFactors: props.patient?.assessment.reliefFactors ?? '',
    sleep: props.patient?.assessment.sleep ?? '',
    description: props.patient?.assessment.description ?? '',
});




// You would also need to add the orientationLevels to your component
const submitForm = () => {
    form.put(route('assessment.update', props.patient?.assessment?.id), {
    });
};
</script>