<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachment';

    /**
     * Retrieves the given resource
     *
     * @return Response
     */
    public function getAttachment($attachmentCode ='')
    {
    	$attachment = $this->where('att_code', $attachmentCode)->first();
        $mime = $this->get_mime_type($attachment->att_name);

        header("Content-length:" . strlen($attachment->att_file));
        header("Content-type: $mime");
        header("Content-Disposition: attachment; filename='$attachment->att_name'");

        return hex2bin($attachment->att_file); 
    }

    /**
     * Provides the mime type of a given filename
     *
     * @return Response
     */
    public function get_mime_type($fileName='')
    {
            $mime_types = array(
                    "pdf"=>"application/pdf"
                    ,"exe"=>"application/octet-stream"
                    ,"zip"=>"application/zip"
                    ,"docx"=>"application/msword"
                    ,"doc"=>"application/msword"
                    ,"xls"=>"application/vnd.ms-excel"
                    ,"ppt"=>"application/vnd.ms-powerpoint"
                    ,"gif"=>"image/gif"
                    ,"png"=>"image/png"
                    ,"jpeg"=>"image/jpg"
                    ,"jpg"=>"image/jpg"
                    ,"mp3"=>"audio/mpeg"
                    ,"wav"=>"audio/x-wav"
                    ,"mpeg"=>"video/mpeg"
                    ,"mpg"=>"video/mpeg"
                    ,"mpe"=>"video/mpeg"
                    ,"mov"=>"video/quicktime"
                    ,"avi"=>"video/x-msvideo"
                    ,"3gp"=>"video/3gpp"
                    ,"css"=>"text/css"
                    ,"jsc"=>"application/javascript"
                    ,"js"=>"application/javascript"
                    ,"php"=>"text/html"
                    ,"htm"=>"text/html"
                    ,"html"=>"text/html"
            );

            return $mime_types[strtolower(pathinfo($fileName, PATHINFO_EXTENSION))];
    }

}
