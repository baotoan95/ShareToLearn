<?php

/**
 * Description of Request_Helper
 *
 * @author BaoToan
 */
function get_data_by_post($field_name) {
    return $this->input->post($field_name);
}

?>