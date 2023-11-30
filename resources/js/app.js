import $ from 'jquery';
window.$ = window.jQuery = $;
require('bootstrap');
require('lazysizes')
import swal from 'sweetalert2';
window.Swal = swal;
import lightGallery from 'lightgallery';
import lgThumbnail from 'lightgallery/plugins/thumbnail'
import lgZoom from 'lightgallery/plugins/zoom'
import lgFullscreen from 'lightgallery/plugins/fullscreen'
import lgRotate from 'lightgallery/plugins/rotate'

window.lightGallery = lightGallery;
window.lgThumbnail = lgThumbnail;
window.lgZoom = lgZoom;
window.lgFullscreen = lgFullscreen;
window.lgRotate = lgRotate;
import DataTable from 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';
window.DataTable = DataTable;
import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';
window.ClassicEditor = ClassicEditor;
import Chart from 'chart.js/auto';
window.Chart = Chart;
import Cleave from 'cleave.js';
window.cleave = Cleave;
require('cleave.js/dist/addons/cleave-phone.vn')
if ($('.number-input').length) {
    var cleave = new Cleave('.number-input', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
}
if ($('.phone-input').length) {
    var cleave = new Cleave('.phone-input', {
        phone: true,
        phoneRegionCode: 'VN'
    });
}
