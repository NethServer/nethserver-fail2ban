/*
 * Copyright (C) 2019 Nethesis S.r.l.
 * http://www.nethesis.it - nethserver@nethesis.it
 *
 * This script is part of NethServer.
 *
 * NethServer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License,
 * or any later version.
 *
 * NethServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with NethServer.  If not, see COPYING.
 */

import c3 from 'c3'

export default function generatePieChart(bindto, data) {
    var $ = window.jQuery
    var c3ChartDefaults = $().c3ChartDefaults()
    var pieChartRightConfig = c3ChartDefaults.getDefaultPieConfig()
    pieChartRightConfig.bindto = bindto
    pieChartRightConfig.data = data
    pieChartRightConfig.data.expand = false
    pieChartRightConfig.data.type = 'pie'
    pieChartRightConfig.color={ pattern:[ $.pfPaletteColors.red,$.pfPaletteColors.blue,$.pfPaletteColors.orange, $.pfPaletteColors.green]};// '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']};
    pieChartRightConfig.size = {
        width: 250,
        height: 250
      };
    return c3.generate(pieChartRightConfig)
}
