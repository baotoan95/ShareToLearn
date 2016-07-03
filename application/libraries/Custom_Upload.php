<?php

/**
 * Description of CustomUpload
 *
 * @author BaoToan
 */
class Custom_Upload {

    function upload_image($image, $dis, $config = array()) {
        $config["upload_path"] = $dis;
        $config["allowed_types"] = "gif|png|jpg|jpeg";
        $config["max_size"] = "900";
        $this->load->library("upload", $config);
        if (!$this->upload->do_upload("avatar")) {
            return FALSE;
        } else {
            return $this->upload->data()["file_name"];
        }
    }

}
