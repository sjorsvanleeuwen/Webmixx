import Axios from 'axios';
import { bootEditor, bootChoices } from './helpers';
import vueBootstrap from './vue_bootstrap';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (document.getElementById('app').classList.contains('no-vue') === false) {
    vueBootstrap();
}
bootEditor();
bootChoices();
