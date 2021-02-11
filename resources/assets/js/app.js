import Axios from 'axios';
import { bootEditor } from './helpers';
import vueBootstrap from './vue_bootstrap';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

vueBootstrap();
bootEditor();
