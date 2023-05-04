import './tiptap';
import './tippy';
import ApexCharts from 'apexcharts';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import persist from '@alpinejs/persist';
import collapse from '@alpinejs/collapse';
import '@nextapps-be/livewire-sortablejs';

window.ApexCharts = ApexCharts;
window.Alpine = Alpine;

Alpine.plugin(focus);
Alpine.plugin(persist);
Alpine.plugin(collapse);
Alpine.start();
