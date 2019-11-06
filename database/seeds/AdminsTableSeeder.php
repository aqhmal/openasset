<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'Admin';
        $admin->email = 'admin@aqhmal.network';
        $admin->password = Hash::make('secret1234');
        $admin->image = 'iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAAAAACIM/FCAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAACxEAAAsRAX9kX5EAAARySURBVHja7dzNleMgDAfwVJcCuFOA7xTgAri7AO4U4AK4U4AL4M5dO2923r79yCRGkpd/bFRA8n4xBBkkbveTxG1ABmRABmRABmRABmRABmRABmRABmRABmRABmRATghxYc30FSVHP70jxPhE/0Rd5zeDuJW+iRrt+0BcpmeR3HtAbKJXkewbQEKlHRHQISbTvtgmaMhUaXd4YIinllhhIW2Oj+FlMCGtDnXJrZdDW6IDcUS9JSoQW1kQymiQjZgRsSCB2OGRIBPfQdUCQTYBhDYciCdRBBSIqTKI1uC6dZzpX+8nIJAqhZCDgHixQ2lZvPX8y9J8JELIpODQeSRCSNSAkO0PKSqQtTtEZWR9rCXdIUEHQnNvSFaCpN4QJYfG2LoBTBGVsSWCeDVI7AsJapCtLySrQeg0ENcVoueg5SyQcBZIHhAFiFWE0ICADa0BGZBTQvKAgEHCWSDLWSDuLLnW/TSQTQ3SN41X2vpVOd6VQWY1yNQXonBeBbH5cL8nlLkuhcwoc1189FZBpogYsqo4yr07ROd1N/aH6GTAEwBEI9/SqKyRF9VkgGVdBSJ/JBpnoRr1Wqn/IqIDsdJCJwMCkb7x6tQ19q0yVSwG7Fr3q7WGqEEkx7swNY3CV0WgKlPRsghV9/sZhjfh9Xrg1BphWBLFDiW91iSGRLPTSrFZrFmi2jGm2oe49nMoN1Q2rCdVuRdRucV12ju8snLTm37T8a4Msi7aX3tAG3invuMjGvPdc0o+pBP8mKsSbPw2H14PujPhsDsf5vWBJXlz1PcdeQvH5GP+VXOe1+AO/C4JZI6fKW+VDxb38+nlOP9/yB8jJ4oGjPntZYZ/VcdNZS5Lum7/TtGYV3UwII/+XfkJx6N7CThXdTRD/OOWkcpMAf3j/+nij4WYUHSPBr5/1y/BHAYxz28L2ZrHtn2aYtYmSgPk5aUnrcPLv/zAcADE7WmnaskG7Z7N7+K0ITv3d/fn50vV3cDbBzH7X2L3/YZuf7vcavQgbdsKr9N017Sdt2+13QVpPcrJT2e9b92VTFoQxsZujd8s9VNk7NxHHQizTKPE+a8xYebI7CSdNSBG0MZaUljcZ4SQJJ9jFCCapaQHnqK8hFiCCCuGRAxIlEJMxYC8PMN+BfEEEl4I2VAgmwxiCSasCLLgQBYRZMOBbBKIIaAwAohHgngBZEWCrAJIQYIUPsQSVFg2xGNBPBsSsSCRDclYkMyGEFhwIRMaZGJCPBrEMyERDRKZkIwGyUxIRYNUHsQQXBgWxOFBHAvi8SCeBQl4kMCCZDxIZkE2PMjGghBgcCAWEWIZEIcIcQzIgghZGJCACAkMSEKEJAYkI0IyA4LoeJL/vhmE2iEOE+KuC1kwIUszJGBCQjMkYUJSMyRjQnIzpGBCSjOEQKMVYlEhphHiUCHuqpCACglXhSRUSGqEZFRIboRsqJCtEUKwcVGIxYXYJojDhbhrQhZcyNIECbiQcE1IwoWkJkjGheRrQgoupDRBCDgGZEAG5NKQH8VLpk1SsfmeAAAAAElFTkSuQmCC';
        $admin->save();
    }
}
