<?php


namespace App\Services;

class AddressService
{
    public static function showAddress($name, $beizhu,$contacts)
    {
        $address = \App\Models\Address;
        $address->name = $name;
        $address->beizhu = $beizhu;
        $address->contacts =$contacts;
        $address->save();

        return $address;
    }
      public static function addAddress($name, $beizhu,$contacts)

      {
          $address = new \App\Models\Address;
          $address->name = $name;
          $address->beizhu = $beizhu;
          $address->contacts =$contacts;
          $address->save();

          return $address;


        }


        public static function deleteAddress($id){

            return \App\Models\Address::where('id', $id)->delete();


        }

    public static function updateAddress($id,$data)
    {
        return \App\Models\Address::where('id', $id)->update(
            [
                'id' =>$data['id'],
                'name' => $data['name'],
                'beizhu' => $data['beizhu'],
                'contacts' => $data['contacts']
            ]);

        }
}
