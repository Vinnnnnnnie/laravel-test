import { router } from '@inertiajs/vue3'
import { showToast } from './Composables/useToast'
import { usePage } from '@inertiajs/vue3';
const page = usePage();
router.on('navigate', (event) => {
    const success = event.detail.page.props.success
    const errors = event.detail.page.props.errors

    console.log('Success' ,success)
    console.log('Errors' ,errors)

    if (success) showToast('success', success)
    
    if (errors) {
        let index = 0;
        for (let error of errors)
        {
            setTimeout(showToast, index*4000, 'error', error)
            index++;
        }
    }
});