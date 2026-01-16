<style type="text/css">
    body {
        margin: 40px;
        font-size: smaller;
        font-family: 'manjari-mal';
        text-align: justify;
    }

    .small-size {
        font-size: x-small;
    }

    .margin-0 {
        margin: 0px;
    }

    .font-bold {
        font-weight: bold;
    }

    .right-left-alignment {
        width: 100%;
        border-collapse: collapse;
    }

    .full-width-row {
        display: flex;
        justify-content: space-between;
    }

    .left-aligned {
        text-align: left;
    }

    .right-aligned {
        text-align: right;
    }
</style>

<!--
<table style="width: 100%;display:none;">
	<tr>
		<td style="vertical-align:text-top;">
			<h2>MAR ATHANASIUS COLLEGE ASSOCIATION</h2>
			<p class="small-size">KOTHAMANGALAM COLLEGE P.O, KERALA, INDIA - 686 666</p>
			<p class="small-size">Phone: 0485-2822328, Telefax: 0485-2825017, 0485-2570255(Res.)</p>
			<p class="small-size">www.macollegeassociation.org &nbsp;&nbsp;&nbsp; Email:maca2955@gmail.com</p><br>

			<table>
				<tr style="vertical-align: text-top;">
					<td style="width: 20%;font-size:x-small;vertical-align:top">MANAGER</td>
					<td>
						<p class="small-size">Mar Athanasius College (Autonomous), Kothamangalam</p>
						<p class="small-size">Mar Athanasius College of Engineering, Kothamangalam</p>
						<p class="small-size">Mar Baselious College, Adimaly</p>
						<p class="small-size">Mar Athanasius College International School, Kothamangalam</p>
					</td>
				</tr>
			</table>
		</td>
		<td style="vertical-align:text-top;text-align: right;">
			<p class="small-size">DR. WINNY VARGHESE</p>
			<p class="small-size">SECRETARY</p>
		</td>
	</tr>
</table> -->



<br><br>
<br><br>
<br><br>
<br>

<table class="margin-0 right-left-alignment">
    <tr class="full-width-row">
        <td class="left-aligned"><?= $lettersDetails->order_no ?></td>
        <td class="right-aligned"><?= date('d-m-Y', strtotime($lettersDetails->letter_date)) ?></td>
    </tr>
</table>

<br><br>
<div>സ്വീകര്‍ത്താവ്
    <div style="margin-left: 20px;">
        <?= $lettersDetails->recipient_name_mal ?>
    </div>
</div>


<br><br>
<table class="margin-0">
    <tr style="vertical-align: top;">
        <td style="vertical-align:top">വിഷയം :-</td>
        <td style="vertical-align:top">
            <?= $lettersDetails->subject ?>
        </td>
    </tr>
</table>
<br><br>
<table class="margin-0">
    <tr style="vertical-align: top;">
        <td style="vertical-align:top">സൂചന :-</td>
        <td style="vertical-align:top">
            <?php
            $i = 1;
            $ordersListStr = $lettersDetails->letter_orders;
            $ordersList = explode("~", $ordersListStr);
            foreach ($ordersList as $orders) :
            ?>
                <span class="font-bold"><?= $i++ ?>)</span> <?= $orders ?>
                <br>
            <?php endforeach; ?>
        </td>
    </tr>
</table>

<br><br>

<span style="text-align: left;"> <?= $lettersDetails->salutation ?>,</span>
<p class="margin-0" style="text-indent: 15%;">
    <?= $lettersDetails->body ?>
</p>

<br>



<table class="margin-0 right-left-alignment">
    <tr class="full-width-row">
        <td class="left-aligned"></td>
        <td class="right-aligned">വിശ്വസ്തതയോടെ,
            <br><br><br><br>
            <?= $lettersDetails->sender_name_mal ?>
        </td>
    </tr>
</table>